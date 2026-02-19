@props(['withIcon' => true])

<div class="relative h-px w-24 mx-auto my-12 bg-gradient-to-r from-transparent via-gold-deep/30 to-transparent">
    @if($withIcon)
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[8px] text-gold-deep/40 bg-ivory px-2">
            ◆
        </div>
    @endif
</div>