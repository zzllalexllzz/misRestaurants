@props([
    'sortable' => null,
    'direction' => null,
    'multiColumn' => null,
])

<th {{ $attributes->merge(['class' => ''])->only('class') }}>
    @unless($sortable)
        <span class="text-uppercase">{{ $slot }}</span>
    @else
        <button {{ $attributes->except('class') }} class="sort-btn text-uppercase d-flex align-items-center">
            {{-- class="flex items-center space-x-1 font-medium text-cool-gray-500 uppercase tracking-wider group focus:outline-none focus:underline"> --}}
            <span>{{ $slot }}</span>

            <span class="d-flex align-items-center">
                @if ($multiColumn)
                    @if ($direction === 'asc')
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    @elseif ($direction === 'desc')
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                            </path>
                        </svg>
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    @else
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    @endif
                @else
                    @if ($direction === 'asc')
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    @elseif ($direction === 'desc')
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    @else
                        <svg style="width: 18px; height: 18px" class="pl-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    @endif
                @endif
            </span>
        </button>
        @endif
    </th>
