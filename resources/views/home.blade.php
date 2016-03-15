@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>
                      <h4><strong>Getting Started</strong></h4>
                      Welcome to the 2016 Camp Old Indian registration system. Here you will be able to input
                      your Troop's information and sign up your scouts for Merit Badge sessions and other activities! Here's
                      a quick guide on getting started -
                    </p>
                    <h4><strong>Step 1:</strong></h4>
                    <p>
                      Input your Troop's information under the <strong>Troop information</strong> tab. This is required
                      in order to move on to the next steps.
                    </p>
                    <h4><strong>Step 2:</strong></h4>
                    <p>
                      Add your scouts and their information to your roster located under the <strong>Scout Registration</strong>
                      tab. Add only the scouts that will be attending camp this summer.
                    </p>
                    <h4><strong>Step 3:</strong></h4>
                    <p>
                      Use <strong>Edit Schedule</strong> to register scouts for classes and sessions. You can come back later to edit
                      your registrations. Please pay special attention to multiple day classes, such as those classes in the NOVA
                      program & BSA Lifeguard.
                    </p>
                    <br>
                    <p>
                      Your done! You can come back at anytime to edit scouts schedules, remove scouts that drop out, edit your troop's
                      information. Check back soon for leader registration!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
