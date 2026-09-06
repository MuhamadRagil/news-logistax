<article class="bg-white border border-slate-200 rounded-xl p-5 hover:border-[#3FA7D6]/60 transition-colors">
    <div class="flex flex-col md:flex-row gap-5">
        @if($article->featuredImage)
            <a href="{{ route('articles.show', $article->slug) }}" class="md:w-52 shrink-0 overflow-hidden rounded-lg">
                <img
                    class="h-36 w-full object-cover"
                    src="{{ asset('storage/' . $article->featuredImage->path) }}"
                    alt="{{ $article->featuredImage->alt_text ?: $article->title }}"
                >
            </a>
        @else
            <div class="md:w-52 h-36 shrink-0 rounded-lg bg-[#F1F5F9]"></div>
        @endif

        <div class="min-w-0">
            <div class="flex items-center gap-2.5 flex-wrap">
                <span class="{{ $article->content_type_badge_class }} text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full">
                    {{ $article->content_type_label }}
                </span>
                @if($article->category)
                    <a href="{{ route('categories.show', $article->category->slug) }}" class="text-[11px] font-bold uppercase tracking-wide text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                        {{ $article->category->name }}
                    </a>
                @endif
                <span class="font-mono text-[11px] text-slate-400">
                    {{ optional($article->published_at)->format('d M Y') }}
                </span>
            </div>

            <a href="{{ route('articles.show', $article->slug) }}" class="block mt-2 text-xl md:text-2xl font-extrabold leading-tight text-[#0F172A] hover:text-[#0F4C6C] transition-colors">
                {{ $article->title }}
            </a>

            <p class="mt-2.5 text-[#475569] leading-relaxed line-clamp-2">
                {{ $article->excerpt }}
            </p>

            <div class="mt-3 font-mono text-[11px] text-slate-400">
                {{ number_format((int) $article->view_count, 0, ',', '.') }} views · {{ $article->read_time_minutes }} menit baca
            </div>
        </div>
    </div>
</article>
