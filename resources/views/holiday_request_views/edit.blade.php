<div class="row justify-content-center">
    <form id="edit_holiday_request" method="POST"  action="{{route('update_holiday_request', ['holiday_id'=>$holiday_request->id])}}">
    @csrf
    @method('PUT')
    <input  class="created-at d-none"  value="{{ date('Y-m-d', strtotime( $holiday_request->created_at)) }}" readonly>
        <div class="form-row">
            <input class="d-none" name="user_id" value="{{Auth::user()->id}}" readonly>
            <div class="col-md-4 mb-3">
            <label for="validationDefault01">First name</label>
            <input type="text" 
                name="name"
                class="form-control" 
                id="validationDefault01" 
                placeholder="First name" 
                value="{{Auth::user()->name}}" 
                required
                readonly>
            </div>
            <div class="col-md-4 mb-3">
            <label for="validationDefault02">Last name</label>
            <input type="text" 
                name="last_name"
                class="form-control" 
                id="validationDefault02" 
                placeholder="Last name" 
                value="{{Auth::user()->last_name}}" 
                required
                readonly>
            </div>
            <div class="col-md-4 mb-3">
            <label for="validationDefaultUsername">e-mail</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                </div>
                <input type="text" 
                    name="email"
                    class="form-control" 
                    id="validationDefaultUsername" 
                    placeholder="e-mail" 
                    value="{{Auth::user()->email}}" 
                    aria-describedby="inputGroupPrepend2" 
                    required
                    readonly>
            </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">From: </label>
                <input type="date"
                    name="date_from" 
                    class="form-control" 
                    id="validationDefault03" 
                    placeholder="DateFrom" 
                    value="{{ date('Y-m-d', strtotime( $holiday_request->started_at)) }}"
                    required
                >
                <p class='text-danger'>{{ $errors->first('date_from') }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationDefault04">To: </label>
                <input type="date" 
                    name="date_to"
                    class="form-control" autocomplete="off" 
                    id="validationDefault04" 
                    placeholder="DateTo" 
                    value="{{ date('Y-m-d', strtotime($holiday_request->finished_at))  }}"
                    required
                >
                <p class='text-danger'>{{ $errors->first('date_to') }}</p>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="validationDefault05">Notes: </label>
                <textarea name="notes" 
                    class="form-control" 
                    id="validationDefault05" 
                    placeholder="Notes..." 
                    required
                >{{ $holiday_request->notes }}</textarea>
                <p class='text-danger'>{{ $errors->first('notes') }}</p>
            </div>
        </div>
        
        <div class="form-row my-2">
            <div class="form-check">
                <input class="form-check-input"  name="sumbit_to_manager" type="checkbox" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Submit to Manager</label>
            </div>
        </div>

        <div class="form-row">
            <button class="btn btn-primary w-100 submit-edit-request-button">
                Submit form
            </button>
        </div>        
    </form>
</div>
<script>
$(document).ready(function(){
    let date_from= $("input[name='date_from']").val();
    let date_to= $("input[name='date_to']").val();
    if( !(new Date(date_from) <= new Date(date_to)) ){
        $("input[name='date_to']").parent().find('.text-danger').html('Not Valid To Date!');
        $('.submit-edit-request-button').prop('disabled', true);
    }

    $("input[name='date_from']").on('change', function(){
        let date_to_edit= $("input[name='date_to']").val();
        let date_from_edit= $("input[name='date_from']").val();
        let created_at=  $('.created-at').val();

        if( !(new Date(date_from_edit) <= new Date(date_to_edit)) ){
            if( !(new Date(date_from_edit) <= new Date(created_at)) ){ 
                $("input[name='date_to']").parent().find('.text-danger').html('Not Valid To Date!').css({'display':'block'});
                $("input[name='date_from']").parent().find('.text-danger').html('').css({'display':'none'});
                $('.submit-edit-request-button').prop('disabled', true);
            }
            else{
                $("input[name='date_from']").parent().find('.text-danger').html('Not Valid To Date!').css({'display':'block'});
                $('.submit-edit-request-button').prop('disabled', true);
            }
        }
        else{
            if(new Date(date_from_edit) < new Date(created_at)){
                console.log(Date(date_from_edit));
                console.log(Date(created_at));
                $("input[name='date_from']").parent().find('.text-danger').html('Not Valid To Date!').css({'display':'block'});
                $('.submit-edit-request-button').prop('disabled', true);
            }
            else{
                $("input[name='date_from']").parent().find('.text-danger').html('').css({'display':'none'});
                $("input[name='date_to']").parent().find('.text-danger').html('').css({'display':'none'});
                $('.submit-edit-request-button').prop('disabled', false);
            }
        }
    });

    $("input[name='date_to']").on('change', function(){
        let date_to_edit= $("input[name='date_to']").val();
        let date_from_edit= $("input[name='date_from']").val();
        let created_at=  $('.created-at').val();
        
        if( !(new Date(date_from_edit) <= new Date(date_to_edit)) ){
            if(new Date(date_from_edit) < new Date(created_at)){
                $("input[name='date_from']").parent().find('.text-danger').html('Not Valid To Date!').css({'display':'block'});
                $('.submit-edit-request-button').prop('disabled', true);
            }
            else{
                $("input[name='date_to']").parent().find('.text-danger').html('Not Valid To Date!').css({'display':'block'});
                $('.submit-edit-request-button').prop('disabled', true);
            }
        }
        else{
            if(new Date(date_from_edit) < new Date(created_at)){
                $("input[name='date_from']").parent().find('.text-danger').html('Not Valid To Date!').css({'display':'block'});
                $('.submit-edit-request-button').prop('disabled', true);
            }
            else{
                $("input[name='date_to']").parent().find('.text-danger').html('').css({'display':'none'}).css({'display':'block'});
                $('.submit-edit-request-button').prop('disabled', false);
            }
        }
    });
});
</script>