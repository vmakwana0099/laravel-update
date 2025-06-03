CKEDITOR.plugins.add('cmsdata',
 {
     init: function(editor) {
             editor.addCommand('cmsdata', new CKEDITOR.dialogCommand('cmsdata'));
             editor.ui.addButton('cmsdata',
                     {
                             label: "Add Common Files",
                             command: 'cmsdata',
                             icon: this.path + 'pdf.gif'
                     });
             //alert(this.path + 'cmsdata.png');
             CKEDITOR.dialog.add('cmsdata', this.path + 'dialogs/cmsdata.js','index.php?module=powerpanel');
     }
 }
);