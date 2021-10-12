<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 footer-copyright text-center">
              <div class="currency-rates">
                <div class="wrapper">
                  @forelse($currency_rates as $key => $rates)
                    <span>{{ $key }} - {{ $rates }}</span>
                  @empty
                  @endforelse
                </div>
              </div>
            </div>
        </div>
    </div>
</footer>
