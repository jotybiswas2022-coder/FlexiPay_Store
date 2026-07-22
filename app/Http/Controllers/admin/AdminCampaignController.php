<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\User;
use App\Models\CampaignLog;

class AdminCampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(20);
        return view('backend.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('backend.campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
            'channel' => 'required|in:email,sms,both',
            'audience' => 'required|in:all,active_users,overdue_users,specific',
            'scheduled_at' => 'nullable|date',
        ]);

        $campaign = Campaign::create($request->all());

        if ($request->status === 'send_now') {
            $this->sendCampaign($campaign);
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully!');
    }

    public function send(Campaign $campaign)
    {
        $this->sendCampaign($campaign);
        return back()->with('success', 'Campaign sent successfully!');
    }

    private function sendCampaign(Campaign $campaign)
    {
        $users = collect();
        switch ($campaign->audience) {
            case 'all':
                $users = User::where('is_active', true)->get();
                break;
            case 'active_users':
                $users = User::where('is_active', true)->where('is_suspended', false)->get();
                break;
            case 'overdue_users':
                $users = User::whereHas('orders.installmentPayments', function($q) {
                    $q->where('status', 'overdue');
                })->get();
                break;
        }

        foreach ($users as $user) {
            CampaignLog::create([
                'campaign_id' => $campaign->id,
                'user_id' => $user->id,
                'channel' => $campaign->channel,
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            // Create notification for user
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'type' => 'promotion',
                'channel' => $campaign->channel === 'both' ? 'email' : $campaign->channel,
                'title' => $campaign->subject ?? $campaign->name,
                'message' => $campaign->content,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        }

        $campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->logs()->delete();
        $campaign->delete();
        return back()->with('success', 'Campaign deleted!');
    }
}
