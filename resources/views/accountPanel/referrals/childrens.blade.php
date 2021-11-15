@php($parent = cache()->remember('us.referrals.'.$us->id, 60, function() use($us) { return $us->getAllReferrals(); }))
@php($self = $parent['self'])

@if($level == 1)
    <tr>
        <td colspan="7">
            <hr>
        </td>
    </tr>
@endif

@if($level > 0)
<tr>
    @php($p = $level > 3 ? 3 : $level)
    <td style="padding-left:{{ $p * 15 }}px;">
        <div class="d-inline-block align-middle">
            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ $self->image ? route('accountPanel.profile.get.avatar', $self->id) : asset('accountPanel/images/user/user.png') }}" alt="">
            <div class="status-circle bg-primary"></div>
            <div class="d-inline-block">
                <span style="font-size: 18px;">{{ $self->name }}</span>
                <p class="font-roboto" style="font-size: 15px; margin-bottom:0;">{{ $self->login }}</p>
                <p style="margin-top:0;">линия {{ $level }}</p>
            </div>
        </div>
    </td>
    <td>{{ $self->phone ?? 'Не указан' }}</td>
    <td>{{ $self->created_at->format('d.m.Y H:i:s') }}</td>
    <td>
        <span class="badge rounded-pill pill-badge-info" style="color: white;font-size: 16px;">{{ $self->partner->login ?? 'undefined' }}</span>
    </td>
    <td>
                            <span class="label">
                              {{ number_format($self->invested(), 2, '.', ' ') ?? 0 }}$
                            </span>
    </td>
    <td class="">
        {{ number_format($self->deposits_accruals(), 2, '.', ' ') ?? 0 }}$
    </td>
    <td>
        {{ number_format($self->referral_accruals(auth()->user()), 2, '.', ' ') }}$
    </td>
</tr>
@endif

@foreach($level == 1 ? \App\Helpers\PaginationHelper::paginate(collect($parent['referrals']), 10) : collect($parent['referrals']) as $referralParent)
@php($self = $referralParent['self'])
@include('accountPanel.referrals.childrens', ['us' => $self, 'level' => $level+1])
@endforeach

@if($level == 0)
    paginator
@endif
