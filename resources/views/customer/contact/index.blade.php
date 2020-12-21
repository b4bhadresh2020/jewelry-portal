@extends('customer.layouts.layoutMaster')

@section('content')
    @include('customer.contact.banner')
    <div class="contact-wrapper">
        <div class="container">
            <div class="contact-icon">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="contact-icon-inner">
                    <img src="{{asset('assets/img/contact-icon1.png')}}">
                    <div class="contact-icon-tet">
                      <h4>+7 777 123 4567</h4>
                      <p>Let's have a <br/> talk together</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="contact-icon-inner">
                    <img src="{{asset('assets/img/contact-icon2.png')}}">
                    <div class="contact-icon-tet">
                      <h4>OUR ADDRESS</h4>
                      <p>555 South Street, <br/> New York City 12345</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="contact-icon-inner">
                    <img src="{{asset('assets/img/contact-icon3.png')}}">
                    <div class="contact-icon-tet">
                      <h4>SCHEDULE</h4>
                      <p>Mon-Fri 07:00-22:00 <br/> Sat-Sun closed</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="contact-form-block">
              <div class="contact-form-block-title">
                  <h2>LEAVE A MESSAGE</h2>
                  <p>Alias minima veritatis unde illo deserunt omnis facilis</p>
              </div>
              @if (session('inquiry_success'))
              <div class="alert alert-success alert-dismissible fade show">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{ session('inquiry_success') }}</strong>
              </div>
              @endif
              <form action="{{url('/contact-store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group required">
                  <label class="control-label" for="input-name">First Name</label>
                  <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="form-control">
                  @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-name">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control">
                    @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                <div class="form-group required">
                  <label class="control-label" for="input-name">Email</label>
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
                  @error('email')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group required">
                  <label class="control-label" for="input-name">Phone</label>
                  <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone" class="form-control">
                  @error('phone')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group required">
                  <label class="control-label" for="input-name">MESSAGE</label>
                  <textarea  rows="5" name="message" placeholder="Message" class="form-control" spellcheck="false">{{ old('message') }}</textarea>
                  @error('message')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                 <div class="form-group required">
                  <label class="control-label" for="input-name">UPLOAD FILE</label>
                  <input type="file" name="file[]" class="form-control" multiple>
                  @error('file')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="send-button">
                  <button type="submit" class="btn btn-primary">send</button>
                </div>
              </form>
            </div>
            <div class="map-block">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238133.1523823325!2d72.6822096696027!3d21.15914250166557!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1605951420214!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
      </div>
@endsection
