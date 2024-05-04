@extends('templates.main')

@section('content')

<!-- Contact Form Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2>Contact Us</h2>
            <form>
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <select class="form-select" id="subject" required>
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
                            <input class="form-check-input" type="radio" name="contactMethod" id="radioEmail" value="email" checked>
                            <label class="form-check-label" for="radioEmail">Email</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="contactMethod" id="radioPhone" value="phone">
                            <label class="form-check-label" for="radioPhone">Phone</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check-label">Interests (Check all that apply)</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox1" value="newsletter">
                            <label class="form-check-label" for="checkbox1">Newsletter</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox2" value="promotions">
                            <label class="form-check-label" for="checkbox2">Promotions</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox3" value="productUpdates">
                            <label class="form-check-label" for="checkbox3">Product Updates</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection