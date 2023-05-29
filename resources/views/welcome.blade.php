@extends('layouts.main')

@section('content')
  <div class="bg-white py-5">
    <div class="my-5 px-4 text-center">
      <h1 class="display-5 fw-bold mt-4">Contact App</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Contact App gives you everything you need to organize your contacts easily.</p>
        <div class="d-flex justify-content-sm-center">
          <a href="#" class="btn btn-primary btn-lg mr-2">Sign up</a>
          <a href="#" class="btn btn-outline-secondary btn-lg">Sign in</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <h3>Data Protection</h3>
        <p>In the event of contact deletion or corruption, keep your contacts secure and unharmed across all of
          your connected accounts.</p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <h3>Notes & Tags</h3>
        <p>Group, search, and filter your contacts using notes and tags.</p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <h3>Birthday Reminders</h3>
        <p>Weekly notifications are sent to you, including birthday reminders.</p>
      </div><!-- /.col-lg-4 -->
    </div>
  </div>
  <section class="bg-white">
    <div class="container py-5">
      <h2 class="my-5 text-center">Easy to try. Fair pricing to upgrade.</h2>
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="font-weight-normal my-0">Free</h4>
          </div>
          <div class="card-body">
            <h3 class="pricing-card-title">$0 <small class="text-muted">/ mo</small></h3>
            <ul class="list-unstyled mt-3 mb-4">
              <li>1,000 Contacts</li>
              <li>Sync 1 Accounts</li>
              <li>Basic Features</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="font-weight-normal my-0">Pro</h4>
          </div>
          <div class="card-body">
            <h3 class="pricing-card-title">$9 <small class="text-muted">/ mo</small></h3>
            <ul class="list-unstyled mt-3 mb-4">
              <li>25,000 Contacts</li>
              <li>Sync 5 Accounts</li>
              <li>Pro Features</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="font-weight-normal my-0">Enterprise</h4>
          </div>
          <div class="card-body">
            <h3 class="pricing-card-title">$15 <small class="text-muted">/ mo</small></h3>
            <ul class="list-unstyled mt-3 mb-4">
              <li>50,000 Contacts</li>
              <li>Sync 7 Accounts</li>
              <li>Advance Features</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md">
          <strong>Contact App</strong>
          <small class="d-block mb-3">© 2021-2022</small>
        </div>
        <div class="col-6 col-md">
          <h5>Features</h5>
          <ul class="list-unstyled text-small">
            <li><a href="#">Email Marketing</a></li>
            <li><a href="#">Email Template</a></li>
            <li><a href="#">Email Broadcast</a></li>
            <li><a href="#">Autoresponder Email</a></li>
            <li><a href="#">RSS-to-Email</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a href="#">Landing page Guide</a></li>
            <li><a href="#">Inbound Marketing Guide</a></li>
            <li><a href="#">Email Marketing Guide</a></li>
            <li><a href="#">Helpdesk Guide</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a href="#">Team</a></li>
            <li><a href="#">Locations</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Terms</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
@endsection
