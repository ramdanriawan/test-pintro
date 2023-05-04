<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($session->user_id) ? $session->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ip_address') ? 'has-error' : ''}}">
    <label for="ip_address" class="control-label">{{ 'Ip Address' }}</label>
    <input class="form-control" name="ip_address" type="text" id="ip_address" value="{{ isset($session->ip_address) ? $session->ip_address : ''}}" required>
    {!! $errors->first('ip_address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_agent') ? 'has-error' : ''}}">
    <label for="user_agent" class="control-label">{{ 'User Agent' }}</label>
    <textarea class="form-control" rows="5" name="user_agent" type="textarea" id="user_agent" required>{{ isset($session->user_agent) ? $session->user_agent : ''}}</textarea>
    {!! $errors->first('user_agent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payload') ? 'has-error' : ''}}">
    <label for="payload" class="control-label">{{ 'Payload' }}</label>
    <textarea class="form-control" rows="5" name="payload" type="textarea" id="payload" required>{{ isset($session->payload) ? $session->payload : ''}}</textarea>
    {!! $errors->first('payload', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('last_activity') ? 'has-error' : ''}}">
    <label for="last_activity" class="control-label">{{ 'Last Activity' }}</label>
    <input class="form-control" name="last_activity" type="number" id="last_activity" value="{{ isset($session->last_activity) ? $session->last_activity : ''}}" required>
    {!! $errors->first('last_activity', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
