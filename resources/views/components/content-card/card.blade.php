<div class="card p-3 border border-2 border-warning d-flex align-items-center me-2 mb-2" style="min-width:250px;">
    <div class="flex-shrink-0">
        <i class="fa-solid fa-tags fa-2xl text-secondary"></i>
    </div>
    <div class="flex-grow-1 ms-2 mt-1">
        {{ @$data['code'] }}
    </div>
    <div class="flex-grow-1 gap-1 ms-2 d-grid">
        <span class="badge rounded-pill text-bg-danger">{{@$data['status']}} <i class="fa-solid fa-share"></i> </span>
    </div>
</div>
