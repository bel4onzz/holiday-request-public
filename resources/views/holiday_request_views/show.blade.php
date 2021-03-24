<div class="row justify-content-center">
    <form method="POST"  action="{{route('store_holiday_request')}}">
    @csrf
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
                    readonly
                >
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationDefault04">To: </label>
                <input type="date" 
                    name="date_to"
                    class="form-control" 
                    id="validationDefault04" 
                    placeholder="DateTo" 
                    value="{{ date('Y-m-d', strtotime( $holiday_request->finished_at)) }}"
                    required
                    readonly
                >
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
                    readonly
                >{{ $holiday_request->notes }}</textarea>
            </div>
        </div>      
    </form>
</div>