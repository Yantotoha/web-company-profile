@extends('layouts.admin')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .message-box {
            background: #fff;
            border-radius: 6px;
            padding: 20px;
            margin-top: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .attachment img {
            width: 100px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .reply-box {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
    </style>
    <div class="container mt-4">
        <h4>Detail Pesan</h4> <a href="{{ route('admin.contact') }}" class="btn btn-sm btn-success mt-3">← Kembali ke
            Dashboard</a>
        <hr>

    </div>

    <div class="container">
        <div class="message-box">
            <div class="d-flex align-items-center mb-3">
                <img src="https://i.pravatar.cc/50?img=3" alt="avatar" class="avatar mr-3" />
                <div>
                    <h5 class="mb-0">{{ $message->name }}</h5>
                    <small class="text-muted">to: me — {{ $message->created_at }} </small>
                </div>
            </div>

            <h5 class="mb-3 font-weight-bold">
                Strengthen your profile with client testimonials
            </h5>

            <p>Hi {{ Auth::user()->name }},</p>
            {{ $message->email }}

            <p>Best regards,<br />{{ $message->name }}</p>

            <hr />
            <h6>Attachments</h6>
            <div class="row">
                <div class="col-md-3 attachment text-center">
                    <img src="https://via.placeholder.com/100x120.png?text=PDF" alt="Attachment" />
                    <p class="mt-2 mb-0"><strong>Goals.pdf</strong></p>
                    <small>1.2 MB</small>
                </div>
                <div class="col-md-3 attachment text-center">
                    <img src="https://via.placeholder.com/100x120.png?text=Marketing" alt="Attachment" />
                    <p class="mt-2 mb-0"><strong>Marketing.pdf</strong></p>
                    <small>529 KB</small>
                </div>
                <div class="col-md-3 attachment text-center">
                    <img src="https://via.placeholder.com/100x120.png?text=Image" alt="Attachment" />
                    <p class="mt-2 mb-0"><strong>Design.png</strong></p>
                    <small>183 KB</small>
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-4">
                <a href="#" class="btn btn-primary btn-sm">Reply</a>
                <a href="#" class="btn btn-outline-secondary btn-sm">Forward</a>
            </div>

            <!-- Reply Form -->
            <div class="reply-box">
                <h6 class="mb-3">Reply to Zachary Ortiz</h6>
                <form action="/admin/message/reply" method="POST">
                    <!-- CSRF token jika pakai Laravel -->
                    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="5" placeholder="Write your reply..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Attachment (optional)</label>
                        <input type="file" class="form-control-file" name="attachment" />
                    </div>

                    <button type="submit" class="btn btn-success">
                        Send Reply
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
