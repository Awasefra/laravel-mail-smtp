@extends('layouts.main')
@section('content')

<div class="container mb-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-4">Send Email</h2>
            <form id="formSendMail">
                @csrf
                <div class="mb-3">
                    <label for="division" class="form-label">Divisi</label>
                    <input type="text" class="form-control" id="division" name="division"
                        placeholder="Masukkan divisi" autocomplete="off" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                    </div>
                </div>
                <div id="emailFields">
                    <div class="row mb-3 align-items-center email-field">
                        <div class="col-md-3 d-flex">
                            <button type="button" class="btn btn-secondary btn-sm me-2" disabled>-</button>
                            <input type="text" class="form-control" id="name_0" name="names[]"
                                placeholder="Masukkan nama penerima" autocomplete="off" required>
                        </div>
                        <div class="col-md-3 d-flex mt-2 mt-md-0">
                            <input type="email" class="form-control me-2" id="email_0" name="emails[]"
                                placeholder="Masukkan email" autocomplete="off" required>
                        </div>
                        <div class="col-md-3 d-flex mt-2 mt-md-0">
                            <input type="number" class="form-control me-2" id="salary_0" name="salaries[]"
                                placeholder="Masukkan gaji" autocomplete="off" required>
                        </div>
                        <div class="col-md-3 d-flex mt-2 mt-md-0">
                            <input type="number" class="form-control me-2" id="allowance_0" name="allowances[]"
                                placeholder="Masukkan tunjangan" autocomplete="off" required>
                            <button type="button" class="btn btn-success btn-sm" onclick="addEmailField()">+</button>
                        </div>
                    </div>
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
                <div class="text-end">
                    <button type="button" onclick="submitForem(this.closest('form'))"
                        class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/send-email-payroll-batch.js"></script>
<script>
    function addEmailField() {
        const emailFields = document.getElementById('emailFields');
        const index = emailFields.children.length;

        const newField = document.createElement('div');
        newField.classList.add('row', 'mb-3', 'align-items-center', 'email-field');
        newField.innerHTML = `
            <div class="col-md-3 d-flex">
                <button type="button" class="btn btn-danger btn-sm me-2" onclick="removeEmailField(this)">-</button>
                <input type="text" class="form-control" id="name_${index}" name="names[]" placeholder="Masukkan nama penerima" autocomplete="off" required>
            </div>
            <div class="col-md-3 d-flex mt-2 mt-md-0">
                <input type="email" class="form-control me-2" id="email_${index}" name="emails[]" placeholder="Masukkan email" autocomplete="off" required>
            </div>
            <div class="col-md-3 d-flex mt-2 mt-md-0">
                <input type="number" class="form-control me-2" id="salary${index}" name="salaries[]" placeholder="Masukkan gaji" autocomplete="off" required>
            </div>
            <div class="col-md-3 d-flex mt-2 mt-md-0">
                <input type="number" class="form-control me-2" id="allowance_${index}" name="allowances[]" placeholder="Masukkan tunjangan" autocomplete="off" required>
                <button type="button" class="btn btn-success btn-sm" onclick="addEmailField()">+</button>
            </div>
        `;
        emailFields.appendChild(newField);
    }

    function removeEmailField(button) {
        const emailFields = document.getElementById('emailFields');
        if (emailFields.children.length > 1) {
            button.closest('.email-field').remove();
        }
    }
</script>

@endsection