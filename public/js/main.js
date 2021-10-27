
// Send pareametars to modal ======================================================================
$(document).on("click", ".open_modal", function () {
    $("#sif").html('ID: '+$(this).data('sif'));
    $("#naziv").html(' '+$(this).data('naziv'));
    $("#link").attr("action", $(this).data('url'));
    $("#query").html($(this).data('query'));
    $("#query-string").val($(this).data('params'));
});

// Send pareametars to modal1 =====================================================================
// $(document).on("click", ".open_modal1", function () {
//     $("#ModalDoc_title").html($(this).data('edit_title'));
//     $("#name").val($(this).data('name'));
//     $("#id_doc").val($(this).data('id_doc'));
//     $("#id").val($(this).data('id'));
//     $("#id_menu").val($(this).data('id_menu'));
//     $("#name_menu").val($(this).data('name_menu'));
//     $("#file").val('');
//     $("#file_desc").html('');
//     $("#file_source").html($(this).data('file_source'));
//     $("#form_doc").attr("action", $(this).data('url'));
//     $("#form_doc").attr("class", $(this).data('css'));
//     $("#query").val($(this).data('query'));
// });

// ================================================================================================
$(document).on("click", ".open_modal2", function () {
    $("#img_source").attr("src", null);
    $("#img_source").attr("src", $(this).data('url'));
    $("#ModalPicture_title").html(' '+$(this).data('title'));
});

// Close flash messages ===========================================================================
$('div.toast-top-full-width').not('.alert-important').delay(3000).fadeOut(350);
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
// ================================================================================================
function closeErrorWindow(a) {
    "use strict";
    // alert('dsada');
    a.setAttribute("style", 'display:none');
}
// ================================================================================================
function delPhoto() {
    document.getElementById('file_source_1').value='';
    document.getElementById('pictures_content').setAttribute("style", 'display:none');
    document.getElementById('pictures').value='';
    document.getElementById('custom-file-label').innerHTML = '';
}

//document.form_doc = undefined;
function checkImage(a, massage1, massage2) {
    "use strict";
    //let  FileSize = document.form_doc.file.files[0].size / 1024 / 1024; // in MB

   let fileSize = a.files[0].size / 1024 / 1024;
   let filename = a.files[0].name;

    //let filename = a.value.substring(a.value.lastIndexOf('\u005C')+1, a.value.length);
   let fileext=filename.substring(filename.lastIndexOf('.')+1,filename.length, filename.length);
    //  alert(fileext);
    // return false;
    if (fileext!=='jpg'
        &&fileext!=='JPG'
        &&fileext!=='jpeg'
        &&fileext!=='JPEG'
        &&fileext!=='gif'
        &&fileext!=='GIF'
        &&fileext!=='png'
        &&fileext!=='PNG')
    {
        document.getElementById('comment').innerHTML = massage2;
        $('#ModalView1').modal('show');
        a.value = '';
        document.getElementById('file_desc_1').value = '';
        return false;
    }

    if (fileSize > 4) {
        document.getElementById('comment').innerHTML = massage1;
        $('#ModalView1').modal('show');
        //alert('File size exceeds 2 MB');
        // $(file).val(''); //for clearing with Jquery
        a.value = '';
        // document.getElementById('file_desc_1').value = '';
        return false;
    }

   let obj = new FileReader();
    obj.onload = function (data) {
       let image = document.getElementById('upload_image');
        image.src = data.target.result;
        document.getElementById('upload_image').setAttribute("data-url", data.target.result);
        document.getElementById('upload_image').setAttribute("data-title", filename);
        document.getElementById('upload_image').setAttribute("title", filename);
        document.getElementById('pictures_content').setAttribute("style", 'display:block');
        document.getElementById('img_source').setAttribute("src", '');
        // image.style= data.target.result;
    };
    obj.readAsDataURL(a.files[0]);

    document.getElementById('file_source_1').value=filename;
}


function checkDocuments(a, massage1, massage2) {
    "use strict";

    //alert('dsadasd');
    //let  FileSize = document.form_doc.file.files[0].size / 1024 / 1024; // in MB

    let fileSize = a.files[0].size / 1024 / 1024;
    let filename = a.files[0].name;

    //let filename = a.value.substring(a.value.lastIndexOf('\u005C')+1, a.value.length);
    let fileext = filename.substring(filename.lastIndexOf('.') + 1, filename.length, filename.length);
    //alert(fileext);
    // return false;
    if (fileext !== 'pdf'
        && fileext !== 'PDF'
        && fileext !== 'docx'
        && fileext !== 'DOCX'
        && fileext !== 'doc'
        && fileext !== 'DOC'
        && fileext !== 'xlsx'
        && fileext !== 'XLSX'
        && fileext !== 'xls'
        && fileext !== 'XLS'
        && fileext !== 'txt'
        && fileext !== 'TXT') {
        document.getElementById('comment').innerHTML = massage2;
        $('#ModalView1').modal('show');
        a.value = '';
        document.getElementById('file_desc').value = '';
        return false;
    }


    if (fileSize > 4) {
        document.getElementById('comment').innerHTML = massage1;
        $('#ModalView1').modal('show');
        //alert('File size exceeds 2 MB');
        // $(file).val(''); //for clearing with Jquery
        a.value = '';
        document.getElementById('file_desc').value = '';
        return false;
    }

    document.getElementById('file_source').innerHTML = ' (' + filename + ') ';






// function saveDocument() {
//     "use strict";
//
//     if ( document.getElementById('id_doc').value == ''&&document.getElementById('file_source').innerHTML == ''){
//         //alert('trtr');
//         document.getElementById('file').required= 'required';
//     }
//     if ( document.getElementById('name').value == ''){
//         document.getElementById('form_doc').className = 'needs-validation was-validated'
//         return false;
//
//     }
//     if ( document.getElementById('id_doc').value == ''&&document.getElementById('file_source').innerHTML == ''){
//         document.getElementById('form_doc').className = 'needs-validation was-validated'
//         return false;
//     }
    // if ( document.getElementById('id_doc').value == ''){
    //     alert('trtr');
    //     document.form_doc.file.value= 'needs-validation was-validated';
    //
    //     return false;
    //
    // }

    //alert('dasdas');
   // form_doc.submit();


}
// Za pagination e funkcijava vo index view-ata===========================================================================
function listSeaarch() {
    "use strict";
    //alert('dasdas');
    form_search.submit();


}
// ===========================================================================
// ===========================================================================
function test() {
    "use strict";
    alert('zoki');



}
function orderBy(order,sort) {
    "use strict";
   let link=window.location.href;

    link = link.replace('&sort=asc', '');
    link = link.replace('&sort=desc', '');
    link = link.replace('?sort=asc', '');
    link = link.replace('?sort=desc', '');

   let urlParams = new URLSearchParams(location.search);
   let order_old=urlParams.get('order');
   let order_page=urlParams.get('page'); // 1234


    link = link.replace('&order='+order_old, '');
    link = link.replace('&page='+order_page, '');

    //alert(link);
   let n = link.includes("?");

    link=n?link+'&sort='+sort:link+'?sort='+sort

    link=link+'&order='+order;

    window.location.href = link;


}

function checkboxStatus(checkbox,description,yes,no) {
    //alert(yes);
    if(checkbox.checked)
        {document.getElementById(description).innerHTML=yes}
    else
        {document.getElementById(description).innerHTML=no}
    //alert(checkbox.checked);

}
// ===========================================================================
function openModal(modal) {
    "use strict";
    $('#'+modal).modal('show')
}
//title e naslovot na modalot koj ke se pokaze najgore so izvicnik vo sivo krukce
function getContentID(id,modal,title,category) {
    "use strict";
     //alert('/'+category+'/show/'+id);


    // return false;
    openModal(modal);

    getJSP('/'+category+'/show/'+id, 'ModalContent_content', getTitle(title),null, 0);

}
//so ova pravime da preku innerHtml dodademe na ovoj div da go kako naslov vo modalot ModalCOntent, i imeto na toa sto barame-primer Muzicari ili bendovi
function getTitle(title) {
    "use strict";
    document.getElementById('ModalContent_title').innerHTML ='<i class=\"fa fa-exclamation-circle text-gray\"></i> '+title;
}

function changeInternationalClub(id) {
    "use strict";
    //alert(id);
    if (id === '0') {
        document.getElementById('club_international').readOnly = false;

    } else {
        document.getElementById('club_international').readOnly = true;
        document.getElementById('club_international').value = '';
    }
}
// function getCodCc(id) {
//     "use strict";
//     // alert(id);
//     // return false;
//     if (id != '') {
//         getJSP('/objects/get_cod_cc/'+id, 'get_cod_cc',null, null, 0);
//     }
//     else {
//         getJSP('/objects/get_cod_cc/0', 'get_cod_cc',null, null, 0);
//     }


