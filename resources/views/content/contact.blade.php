@extends('templates.main')

@section('content')

<!-- Contact Form Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            @if(Session::flash('success'))
            <div class="alert alert-success" role="alert">
                Message has been sent!
            </div>
            @endif
            <h2>Contact Us</h2>
            <form action="/forms/contact" id="contact-form" method="post">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" maxlength="100" name="name" class="form-control" id="fullName" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" maxlength="100" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" maxlength="100" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <select name="subject" class="form-select" id="subject" required>
                        <option value="">Select a subject</option>
                        <option value="general">General Inquiry</option>
                        <option value="support">Technical Support</option>
                        <option value="billing">Billing & Payments</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-check-label">Preferred Contact Method</label>
                    <div>
                        <div class="form-check">
                            <input name="preferred_contact" class="form-check-input" type="radio" name="contactMethod" id="radioEmail" value="email" checked>
                            <label class="form-check-label" for="radioEmail">Email</label>
                        </div>
                        <div class="form-check">
                            <input name="preferred_contact" class="form-check-input" type="radio" name="contactMethod" id="radioPhone" value="phone">
                            <label class="form-check-label" for="radioPhone">Phone</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check-label">Interests (Check all that apply)</label>
                    <div>
                        <div class="form-check">
                            <input name="interests[]" class="form-check-input" type="checkbox" id="checkbox1" value="newsletter">
                            <label class="form-check-label" for="checkbox1">Newsletter</label>
                        </div>
                        <div class="form-check">
                            <input name="interests[]" class="form-check-input" type="checkbox" id="checkbox2" value="promotions">
                            <label class="form-check-label" for="checkbox2">Promotions</label>
                        </div>
                        <div class="form-check">
                            <input name="interests[]" class="form-check-input" type="checkbox" id="checkbox3" value="productUpdates">
                            <label class="form-check-label" for="checkbox3">Product Updates</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" maxlength="7000" class="form-control" id="message" rows="4" placeholder="Enter your message" required></textarea>
                </div>
                <input type="hidden" id="timezone" name="timezone" value="">
                <button class="btn btn-primary g-recaptcha" data-sitekey="{!! _c('form.recaptcha.site_key') !!}" data-callback='onSubmit' data-action='submit'>Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="https://www.google.com/recaptcha/api.js"></script>

<script>
function onSubmit(token) {
    document.getElementById("contact-form").submit();
}
</script>

<script>
document.getElementById('timezone').value = Intl.DateTimeFormat().resolvedOptions().timeZone;
</script>

@endpush