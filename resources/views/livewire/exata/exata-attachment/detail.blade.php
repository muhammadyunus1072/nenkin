
<div class="row d-flex justify-content-center">
    @foreach ($attachments as $index => $image)
        <div class="col-md-10 mb-3 position-relative">
            <a href="{{ Storage::url($image['file']) }}" download="{{$image['name']}}" class="position-absolute btn btn-primary btn-sm p-2 m-4">
                <i class="fa fa-download"></i>
                Download
            </a>
                @php
                    if (is_array($image)) {
                        $ext = pathinfo($image['file'], PATHINFO_EXTENSION);
                        $url = Storage::url($image['file']);
                    }

                    $ext = strtolower($ext);
                @endphp
                @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))

                    <img src="{{ $url }}" class="img-fluid rounded">
                @elseif(in_array($ext, ['pdf']))
                    <iframe
                        src="{{ route('exata.view_pdf', ['id' => Crypt::encrypt($image['id']), 'type' => $attachment_type]) }}"
                        width="100%"
                        height="900"
                        style="border:none">
                    </iframe>
                @else
                    <div class="border rounded p-4 text-center bg-light">
                        <i class="bi bi-file-earmark fs-1"></i>
                        <div class="mt-2">
                            {{ $image['name'] }}
                        </div>
                    </div>

                @endif
                
        </div>
        <hr>
    @endforeach
</div>