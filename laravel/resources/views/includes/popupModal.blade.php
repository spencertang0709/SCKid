{{--THIS IS USED TO POP UP MODAL--}}
<script>
function showModalBox(selectedItem){
    $(selectedItem).attr('class','modal fade in');
    $(selectedItem).attr('style','display: block;');
    $('body').attr('class','modal-open');

    $('button:contains("Close"),button[class="close"]').on('click',function(){
        $(selectedItem).attr('class','modal fade');
        $('body').attr('class','');
        $(selectedItem).attr('style','display: none;');
    });
}
</script>
<script>
// check something if it is exist, especially for kid;
// pass v as parameter to be checked
// pass modal element
function checkKid(v,modalName){
    if(v==""){         
        showModalBox(modalName);
    }
    else{
         //showModalBox(modalName);
    }
}
</script>
{{--alert--}}
<div class="modal fade" id="nonKidAlert" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Choose Kid</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;&nbsp;Please add one of you kids.
                </div>
            </div>
        </div>
    </div>
</div>
{{--alert--}}
