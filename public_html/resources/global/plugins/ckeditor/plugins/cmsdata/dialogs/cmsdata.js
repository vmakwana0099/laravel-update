var htmlData;

var weburl = "http://192.168.1.25/globalfidelitybank/nlive/powerpanel/pages/cmsplugin";
//var weburl = "http://www.palacehotel.com.my/beta/powerpanel/pages/cmsplugin";

CKEDITOR.dialog.add('cmsdata', function(editor) {
   // CKEDITOR.skins.load(editor, 'cmsdata');
    return {
        title: 'Select PDF / Doc File',
        minWidth: CKEDITOR.env.ie ? 200 : 190,
        minHeight : CKEDITOR.env.ie ? 310 : 280,
        contents: [
        {
            id: 'cms_plugin',
            label: '',
            title: '',
            expand: true,
            padding: 0,
            elements :
            [
            {
                type : 'html',
                html: $.ajax({
                    url: weburl,
                    type: "GET",
                    // data: ({id : this.getAttribute('id')}),
                    async:false,
                    success: function(data){
                        
                        htmlData = data;
                    //editorInstance.insertHtml('You pressed Enter.');
                    }
                }).responseText
            }
            ]
        }
        ],
        //buttons : [ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ],
        onOk : function() {
            // "this" is now a CKEDITOR.dialog object.
            // Accessing dialog elements:
            // alert(editorInstance);
            // editorInstance.insertHtml(htmlData);

            var countcommonfile = document.getElementById('countcommonfile').value;
           
            var fstring='';

            for(var i=1;i<=countcommonfile;i++)
            {
                if(document.getElementById('page'+i).checked==true)
                {
                    
                    fstring+=document.getElementById(i).value;
                }

            }

            var sValue=fstring;

            if(sValue.length == 0)
            {
                alert('Please select at least one record.') ;
                return false ;
            }
            else
            {
                this._.editor.insertHtml(sValue);
                for(var i=1;i<=countcommonfile;i++)
            {
                document.getElementById('page'+i).checked=false 

                    

            }
            //editorInstance.insertHtml(sValue);
            }




        //var textareaObj = this.getContentElement( 'cms_plugin', 'textareaId' );
        //alert( "You have entered: " )//+ textareaObj.getValue() );
        }
    };
});
