@extends('backEnd.layouts.masters')
@section('Page-Title','Change Your Site Settings Here')
@section('content')

 <div class="row">
        <div class="col-md-12 grid-margin">
            <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <!-- Save Button Moved to the Top -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-primary text-white">Save Settings</button>
                </div>

                <!-- Website Section -->
                <div class="card shadow-lg mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Website Fields -->
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold"> Website Name </label>
                                <input type="text" name="website_name" value="{{ $setting->website_name ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Website Logo</label>
                                <div class="mb-2">
                                    <img src="{{ Storage::url($setting?->website_logo ?? '') }}" alt=""
                                        class="img-thumbnail" style="width: 150px; height: auto;" value="{{ $setting?->website_logo }}">
                                </div>
                                <input type="file" class="form-control" name="website_logo">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold"> Website Url </label>
                                <input type="text" name="website_url" value="{{ $setting->website_url ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold"> Website Title </label>
                                <input type="text" name="website_title" value="{{ $setting->website_title ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold"> Page Title </label>
                                <input type="text" name="page_title" value="{{ $setting->page_title ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold"> Meta Keywords </label>
                                <textarea name="meta_keywords" class="form-control" rows="3">{{ $setting->meta_keywords ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold"> Meta Description </label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ $setting->meta_description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Website Information Section -->
                <div class="card shadow-lg mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $setting->address ?? '' }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Phone 1 *</label>
                                <input type="text" name="phone1" value="{{ $setting->phone1 ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Phone No. 2</label>
                                <input type="text" name="phone2" value="{{ $setting->phone2 ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Email Id. 1 *</label>
                                <input type="text" name="email1"
                                    value="{{ $setting->email1 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Email Id 2</label>
                                <input type="text" name="email2"
                                    value="{{ $setting->email2 ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Section -->
                <div class="card shadow-lg mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website - Social Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Facebook (Optional)</label>
                                <input type="text" name="facebook" value="{{ $setting->facebook ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Twitter (Optional)</label>
                                <input type="text" name="twitter" value="{{ $setting->twitter ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Instagram (Optional)</label>
                                <input type="text" name="instagram" value="{{ $setting->instagram ?? '' }}"
                                    class="form-control">
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label class="fw-bold">Youtube (Optional)</label>
                                <input type="text" name="youtube" value="{{ $setting->youtube ?? '' }}"
                                    class="form-control">
                            </div> --}}
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
