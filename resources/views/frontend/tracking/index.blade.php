@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@push('styles')
<style>
    .timeline {
        /* Used to position the left vertical line */
        position: relative;
    }

    .timeline__line {
        /* Border */
        border-right: 2px solid #a6b9d6;

        /* Positioned at the left */
        left: 0.75rem;
        position: absolute;
        top: 0px;

        /* Take full height */
        height: 100%;
    }

    .timeline__items {
        /* Reset styles */
        list-style-type: none;
        margin: 0px;
        padding: 0px;
    }

    .timeline__item {
        margin-bottom: 20px;
    }

    .timeline__top {
        /* Center the content horizontally */
        align-items: center;
        display: flex;
    }

    .timeline__circle {
        /* Rounded border */
        background-color: #a6b9d6;
        border-radius: 9999px;

        /* Size */
        height: 1.5rem;
        width: 1.5rem;
    }

    .timeline__title {
        /* Take available width */
        flex: 1;
        margin-left: 0.5rem;
    }

    .timeline__desc {
        /* Make it align with the title */
        margin-left: 2rem;
    }
</style>
@endpush



@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="timeline">
                <!-- Left vertical line -->
                <div class="timeline__line"></div>

                <!-- The timeline items timeline -->
                <div class="timeline__items">
                    <!-- Each timeline item -->
                    @foreach (collect($response->history)->reverse() as $timeline)
                        <div class="timeline__item">
                            <!-- The circle and title -->
                            <div class="timeline__top">
                                <!-- The circle -->
                                <div class="timeline__circle"></div>
                        
                                <!-- The title -->
                                <div class="timeline__title">{{ $timeline->status }}</div>
                            </div>
                        
                            <!-- The description -->
                            <div class="timeline__desc">
                                <small class="text-muted">{{ $timeline->note }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection