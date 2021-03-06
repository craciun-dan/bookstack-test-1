@extends('base')

@section('content')

    @include('settings/navbar', ['selected' => 'settings'])

<div class="container small settings-container">

    <h1>Settings</h1>

    <form action="/settings" method="POST" ng-cloak>
        {!! csrf_field() !!}

        <h3>App Settings</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="setting-app-name">Application name</label>
                    <input type="text" value="{{ setting('app-name', 'BookStack') }}" name="setting-app-name" id="setting-app-name">
                </div>
                <div class="form-group">
                    <label>Allow public viewing?</label>
                    <div toggle-switch name="setting-app-public" value="{{ setting('app-public') }}"></div>
                </div>
                <div class="form-group">
                    <label>Enable higher security image uploads?</label>
                    <p class="small">For performance reasons, all images are public. This option adds a random, hard-to-guess string in front of image urls. Ensure directory indexes are not enabled to prevent easy access.</p>
                    <div toggle-switch name="setting-app-secure-images" value="{{ setting('app-secure-images') }}"></div>
                </div>
                <div class="form-group">
                    <label for="setting-app-editor">Page editor</label>
                    <p class="small">Select which editor will be used by all users to edit pages.</p>
                    <select name="setting-app-editor" id="setting-app-editor">
                        <option @if(setting('app-editor') === 'wysiwyg') selected @endif value="wysiwyg">WYSIWYG</option>
                        <option @if(setting('app-editor') === 'markdown') selected @endif value="markdown">Markdown</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="logo-control">
                    <label for="setting-app-logo">Application logo</label>
                    <p class="small">This image should be 43px in height. <br>Large images will be scaled down.</p>
                    <image-picker resize-height="43" show-remove="true" resize-width="200" current-image="{{ setting('app-logo', '') }}" default-image="/logo.png" name="setting-app-logo" image-class="logo-image"></image-picker>
                </div>
                <div class="form-group" id="color-control">
                    <label for="setting-app-color">Application primary color</label>
                    <p class="small">This should be a hex value. <br> Leave empty to reset to the default color.</p>
                    <input  type="text" value="{{ setting('app-color', '') }}" name="setting-app-color" id="setting-app-color" placeholder="#0288D1">
                    <input  type="hidden" value="{{ setting('app-color-light', '') }}" name="setting-app-color-light" id="setting-app-color-light" placeholder="rgba(21, 101, 192, 0.15)">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="setting-app-custom-head">Custom HTML head content</label>
            <p class="small">Any content added here will be inserted into the bottom of the &lt;head&gt; section of every page. This is handy for overriding styles or adding analytics code.</p>
            <textarea name="setting-app-custom-head" id="setting-app-custom-head">{{ setting('app-custom-head', '') }}</textarea>
        </div>

        <hr class="margin-top">

        <h3>Registration Settings</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="setting-registration-enabled">Allow registration?</label>
                    <div toggle-switch name="setting-registration-enabled" value="{{ setting('registration-enabled') }}"></div>
                </div>
                <div class="form-group">
                    <label for="setting-registration-role">Default user role after registration</label>
                    <select id="setting-registration-role" name="setting-registration-role" @if($errors->has('setting-registration-role')) class="neg" @endif>
                        @foreach(\BookStack\Role::visible() as $role)
                            <option value="{{$role->id}}" data-role-name="{{ $role->name }}"
                                    @if(setting('registration-role', \BookStack\Role::first()->id) == $role->id) selected @endif
                                    >
                                {{ $role->display_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="setting-registration-confirmation">Require email confirmation?</label>
                    <p class="small">If domain restriction is used then email confirmation will be required and the below value will be ignored.</p>
                    <div toggle-switch name="setting-registration-confirmation" value="{{ setting('registration-confirmation') }}"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="setting-registration-restrict">Restrict registration to domain</label>
                    <p class="small">Enter a comma separated list of email domains you would like to restrict registration to. Users will be sent an email to confirm their address before being allowed to interact with the application.
                        <br> Note that users will be able to change their email addresses after successful registration.</p>
                    <input type="text" id="setting-registration-restrict" name="setting-registration-restrict"
 placeholder="No restriction set" value="{{ setting('registration-restrict', '') }}">
                </div>
            </div>
        </div>

        <hr class="margin-top">

        <h3>Export Books/Chapters</h3>

        <div class="form-group">
            <label for="setting-pdfparser">Export Method</label>
            <p class="small">Select which method will be used to convert books or chapters to PDF:</p>
            <select name="setting-pdfparser" id="setting-pdfparser">
                <option @if(setting('pdfparser') === 'script') selected @endif value="script">External (PHP Script)</option>
                <option @if(setting('pdfparser') === 'dompdf') selected @endif value="dompdf">Internal (Built-in dompdf)</option>
            </select>
        </div>
        <p class="small">The <i>Internal (Built-in dompdf)</i> method uses the built-in PDF parser. The <i>External (PHP Script)</i> method allows you to use an (external) converter of your choice, and enter the desired commands in the <i>app/Services/PdfConvertBook.php</i>, <i>app/Services/PdfConvertChapter.php</i> and <i>app/Services/PdfConvertPage.php</i> files.</p>
<!--	<p class="small"><i>The export functionality is accessible via the entries Page to PDF, Chapter to PDF and Book to PDF.</i></p> -->

        <hr class="margin-top">

        <h3>Display Chapter Indexes</h3>

            <p class="small">This option will use counters for chapters and pages.</p>
            <div class="form-group">
                <label>Display indexes for chapters and pages?</label>
                <div selected toggle-switch name="setting-display-indexes" value="{{ setting('display-indexes') }}"></div>
            </div>

        <hr class="margin-top">

        <div class="form-group">
            <span class="float right muted">
                BookStack @if(strpos($version, 'v') !== 0) version @endif {{ $version }}
            </span>
            <button type="submit" class="button pos">Save Settings</button>
        </div>
    </form>

</div>

@include('partials/image-manager', ['imageType' => 'system'])

@stop

@section('scripts')
    <script src="/libs/jq-color-picker/tiny-color-picker.min.js?version=1.0.0"></script>
    <script type="text/javascript">
        $('#setting-app-color').colorPicker({
            opacity: false,
            renderCallback: function($elm, toggled) {
                var hexVal = '#' + this.color.colors.HEX;
                var rgb = this.color.colors.RND.rgb;
                var rgbLightVal = 'rgba('+ [rgb.r, rgb.g, rgb.b, '0.15'].join(',') +')';
                // Set textbox color to hex color code.
                var isEmpty = $.trim($elm.val()).length === 0;
                if (!isEmpty) $elm.val(hexVal);
                $('#setting-app-color-light').val(isEmpty ? '' : rgbLightVal);
                // Set page elements to provide preview
                $('#header, .image-picker .button').css('background-color', hexVal);
                $('.faded-small').css('background-color', rgbLightVal);
                $('.setting-nav a.selected').css('border-bottom-color', hexVal);
            }
        });
    </script>
@stop
