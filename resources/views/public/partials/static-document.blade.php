{{-- Expects $pageKey matching public.pages.{key} in lang files --}}
@php
    $doc = __('public.pages.' . $pageKey);
@endphp

<div class="page-static-doc">
    <section class="mb-4">
        <div class="about-hero brand-card rounded-4 p-4 p-md-5">
            <p class="small text-uppercase text-brand-gold fw-semibold mb-2 static-doc-eyebrow">{{ $doc['hero_eyebrow'] }}</p>
            <h1 class="h2 mb-2">{{ $doc['hero_title'] }}</h1>
            <p class="brand-muted mb-0">{{ $doc['hero_lead'] }}</p>
        </div>
    </section>

    @foreach ($doc['sections'] as $block)
        @if (! empty($block['question']))
            <section class="about-panel brand-card rounded-4 p-4 p-md-4 mb-3 mb-md-4">
                <dl class="mb-0">
                    <dt class="small text-uppercase text-brand-gold fw-semibold mb-0 static-doc-faq-q">{{ $block['question'] }}</dt>
                    <dd class="brand-muted mb-0 mt-2">{{ $block['answer'] }}</dd>
                </dl>
            </section>
        @else
            <section class="about-panel brand-card rounded-4 p-4 p-md-4 mb-3 mb-md-4">
                <h2 class="h4 mb-3">{{ $block['heading'] }}</h2>
                @if (! empty($block['body']))
                    <p class="brand-muted mb-0">{{ $block['body'] }}</p>
                @endif
                @if (! empty($block['items']))
                    <ul class="list-unstyled mb-0 mt-2 d-flex flex-column gap-2">
                        @foreach ($block['items'] as $item)
                            <li class="d-flex gap-2">
                                <span class="static-doc-bullet" aria-hidden="true"></span>
                                <span class="brand-muted">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        @endif
    @endforeach
</div>
