@extends('layouts.main')
@section('content')

<div class="container mb-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-4">Send Email</h2>
            <form id="formSendMailWithAttach">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama penerima"
                        autocomplete="off" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda"
                        autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject"
                        placeholder="Masukkan subject email" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="4"
                        placeholder="Tulis pesan di sini" autocomplete="off" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Lampiran</label>
                    <input type="file" class="form-control" id="file" name="file" rows="4"
                        placeholder="Upload file di sini" autocomplete="off" required></input>
                </div>
                <div class="text-end">
                    <button type="button" onclick="submitForem(this.closest('form'))"
                        class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/js/send-email-attach.js">
</script>
@endsection