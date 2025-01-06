<div>
    <form id="cart_addonfrm_{{$key}}" action="#" method="post">
        <input type="hidden" id="ele_key" name="ele_key" value="{{$key}}">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <table>
        </table>
    </form>
</div>