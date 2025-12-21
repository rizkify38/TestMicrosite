@extends('admin.layout')

@section('header_title', 'Dashboard Overview')

@section('content')
<!-- Filter Section -->
<div class="card shadow-sm mb-4">
    <div class="card-body py-3">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted">Start Date</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                    <input type="date" class="form-control" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted">End Date</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                    <input type="date" class="form-control" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary-brand w-100">
                    <i class="bi bi-funnel me-1"></i> Apply Filter
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light border" title="Reset Filters">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Stats Indicators -->
<div class="row g-4 mb-4">
    <!-- Card 1 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fs-7 mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">Visits in Range</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalVisits) }}</h3>
                </div>
                <div class="rounded-3 p-2 bg-primary-subtle text-primary">
                    <i class="bi bi-eye fs-4"></i>
                </div>
            </div>
            <div class="mt-3">
                <small class="text-muted">
                    {{ $startDate->format('d M') }} - {{ $endDate->format('d M Y') }}
                </small>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fs-7 mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">Registered Users</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalClaims) }}</h3>
                </div>
                <div class="rounded-3 p-2 bg-success-subtle text-success">
                    <i class="bi bi-people fs-4"></i>
                </div>
            </div>
            <div class="mt-3">
                <small class="text-muted">
                    In selected range
                </small>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fs-7 mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">Today's Visits</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($todayVisits) }}</h3>
                </div>
                <div class="rounded-3 p-2 bg-info-subtle text-info">
                    <i class="bi bi-calendar-event fs-4"></i>
                </div>
            </div>
            <div class="mt-3">
                <small class="text-muted">Today (Absolute)</small>
            </div>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fs-7 mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">This Week</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($thisWeekVisits) }}</h3>
                </div>
                <div class="rounded-3 p-2 bg-warning-subtle text-warning">
                    <i class="bi bi-graph-up fs-4"></i>
                </div>
            </div>
            <div class="mt-3">
                <small class="text-muted">Current week (Absolute)</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Chart Section -->
    <div class="col-lg-8">
        <div class="card h-100 shadow-sm">
            <div class="card-header border-0 bg-white py-3">
                <h5 class="card-title fw-bold mb-0">Traffic & Registration Trends</h5>
                <small class="text-muted">Showing data from {{ $startDate->format('d M') }} to {{ $endDate->format('d M Y') }}</small>
            </div>
            <div class="card-body pt-0">
                <div style="height: 350px;">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Pages -->
    <div class="col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header border-0 bg-white py-3">
                <h5 class="card-title fw-bold mb-0">Popular Pages</h5>
                <small class="text-muted">Based on selected range</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-2 fs-7 text-uppercase text-muted fw-bold border-0">Page URL</th>
                                <th class="pe-4 py-2 text-end fs-7 text-uppercase text-muted fw-bold border-0">Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pageVisits as $page)
                            <tr>
                                <td class="ps-4 border-bottom-0">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded p-1 bg-light me-2 border text-muted">
                                            <i class="bi bi-link-45deg"></i>
                                        </div>
                                        <span class="fw-medium text-dark text-truncate" style="max-width: 150px;" title="{{ $page->page_url }}">{{ $page->page_url == '/' ? 'Homepage' : $page->page_url }}</span>
                                    </div>
                                </td>
                                <td class="text-end pe-4 fw-bold text-dark border-bottom-0">{{ number_format($page->total) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">No visits in this range.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registered Users -->
<div class="card shadow-sm mb-4">
    <div class="card-header border-0 bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h5 class="card-title fw-bold mb-0">Registered Users</h5>
            <small class="text-muted">Voucher claims history</small>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex">
                <!-- Keep date range params if they exist -->
                <input type="hidden" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
                <input type="hidden" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
                
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="search" placeholder="Search user..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    @if($search)
                    <a href="{{ route('admin.dashboard', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="btn btn-outline-danger" title="Clear Search"><i class="bi bi-x-lg"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Contact</th>
                        <th>Product Info</th>
                        <th>Voucher</th>
                        <th class="pe-4 text-end">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentClaims as $claim)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    {{ substr($claim->customer_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $claim->customer_name }}</div>
                                    <!-- <div class="small text-muted">ID: #{{ $claim->id }}</div> -->
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small text-dark">{{ $claim->customer_email }}</div>
                            <div class="small text-muted">{{ $claim->customer_phone }}</div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $claim->product_type == 'kecap' ? 'dark' : 'danger' }} rounded-pill mb-1">
                                {{ ucfirst($claim->product_type) }}
                            </span>
                            <div class="small text-muted text-truncate" style="max-width: 150px;">{{ $claim->product_name }}</div>
                        </td>
                        <td>
                            <code class="bg-light px-2 py-1 rounded text-primary border">{{ $claim->voucherCode->code ?? 'N/A' }}</code>
                        </td>
                        <td class="pe-4 text-end text-muted small">
                            {{ $claim->created_at->format('d M, H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                No user registrations found matching criteria.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-top">
             {{ $recentClaims->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Recent Visitors Log -->
<div class="card shadow-sm mb-4">
    <div class="card-header border-0 bg-white py-3">
        <h5 class="card-title fw-bold mb-0">Recent Visitors Log</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-sm align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Time</th>
                        <th>Page</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentVisitors as $visit)
                    <tr>
                        <td class="ps-4">{{ $visit->visited_at->format('d M H:i:s') }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $visit->page_url }}</span></td>
                        <td><span class="font-monospace small">{{ $visit->ip_address }}</span></td>
                        <td class="text-muted small text-truncate" style="max-width: 300px;">{{ $visit->user_agent }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">No visits log.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-top">
             {{ $recentVisitors->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        
        // Create gradient
        const gradientVisit = ctx.createLinearGradient(0, 0, 0, 400);
        gradientVisit.addColorStop(0, 'rgba(211, 47, 47, 0.2)');
        gradientVisit.addColorStop(1, 'rgba(211, 47, 47, 0.0)');

        const gradientReg = ctx.createLinearGradient(0, 0, 0, 400);
        gradientReg.addColorStop(0, 'rgba(28, 200, 138, 0.2)');
        gradientReg.addColorStop(1, 'rgba(28, 200, 138, 0.0)');

        const chartConfig = {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    {
                        label: 'Page Visits',
                        data: {!! json_encode($chartData['visits']) !!},
                        borderColor: '#d32f2f', // Primary Red
                        backgroundColor: gradientVisit,
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#d32f2f',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Smooth curves
                    },
                    {
                        label: 'Registrations',
                        data: {!! json_encode($chartData['claims']) !!},
                        borderColor: '#1cc88a', // Success Green
                        backgroundColor: gradientReg,
                        borderWidth: 2,
                        borderDash: [5, 5], // Dashed line for secondary metric
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#1cc88a',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1f2937',
                        bodyColor: '#6b7280',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 10,
                        titleFont: {
                            size: 13,
                            weight: 'bold',
                            family: "'Inter', sans-serif"
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif"
                        },
                        displayColors: true,
                        boxPadding: 4
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 10, // Prevent 0-1 scale being too huge
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            },
                            color: '#9ca3af',
                            padding: 10,
                            stepSize: 1
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            },
                            color: '#9ca3af'
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        };

        new Chart(ctx, chartConfig);
    });
</script>
@endpush
