<div class="flex justify-center items-center gap-3 pt-5 text-[#374151] cursor-default">
    <div class="{{$fb == "t1" ? "green-side" : ($fb == "t2" ? "red-side" : "#374151") }} group flex w-[24px] h-[29px] relative" title="Первая кровь">
        <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
            FB
        </div>
        <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z"
                  stroke="{{ $fb == "t1" ? "#92a525" : ($fb == "t2" ? "#c23c2a" : "#374151") }}" stroke-width="2px"></path>
        </svg>
    </div>
    <div class="{{ $f10k == "t1" ? "green-side" : ($f10k == "t2" ? "red-side" : "#374151")}}
        group flex w-[24px] h-[29px] relative" title="Первые 10 убийств" style="transition-delay: 0.2s">
        <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
            F10
        </div>
        <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z"
                  stroke="{{ $f10k == "t1" ? "#92a525" : ($f10k == "t2" ? "#c23c2a" : "#374151") }}" stroke-width="2px"></path>
        </svg>
    </div>
    <div class="{{ $ftd == "t1" ? "green-side" : ($ftd == "t2" ? "red-side" : "#374151") }} group flex w-[24px] h-[29px] relative" title="Первая башня" style="transition-delay: 0.4s">
        <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
            T1
        </div>
        <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z"
                  stroke="{{ $ftd == "t1" ? "#92a525" : ($ftd == "t2" ? "#c23c2a" : "#374151") }}" stroke-width="2px"></path>
        </svg>
    </div>
    <div class="{{ $feck == "t1" ? "green-side" : ($feck == "t2" ? "red-side" : "#374151")}} group flex w-[24px] h-[29px] relative" title="Первое убийство Рошана" style="transition-delay: 0.6s">
        <div class="absolute font-bold text-[9px] w-full text-center top-[1px]">
            R
        </div>
        <svg class="group-hover:scale-125 transition" width="24" height="31" viewBox="0 0 24 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.722244 21.2978L0.727002 3.12362L12.0024 0.666687L23.2778 3.12362V21.3049L12.0105 29.6666L0.722244 21.2978Z"
                  stroke="{{ $feck == "t1" ? "#92a525" : ($feck == "t2" ? "#c23c2a" : "#374151")}}" stroke-width="2px"></path>
        </svg>
    </div>
</div>
