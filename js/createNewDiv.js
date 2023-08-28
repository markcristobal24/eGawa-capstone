var reader = new FileReader();




function clearInputs() {
  // var imageInput = document.getElementById('uploadInput');
  // var imageCleared = document.getElementById('uploadedImageCatalog');
  // var catalogTitle = document.getElementById('catalogTitle');
  // var catalogDescription = document.getElementById('catalogDescription');

  // Reset the image input
  // imageInput.value = null;
  // imageCleared.src = '../img/uploadIMG.png';

  // Reset the title and description inputs
  // catalogTitle.value = '';
  // catalogDescription.value = '';

}





//for image upload in catalog
function catalogImgUp(event) {
  reader.onload = function () {
    var uploadedImagecatalog = document.getElementById('uploadedImageCatalog');
    uploadedImagecatalog.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}

//for image upload in EDIT PROFILE
function editImgUp(event) {
  reader.onload = function () {
    var uploadedImageEdit = document.getElementById('uploadedEditImage');
    uploadedImageEdit.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}



var catalog = document.getElementById('addCatalog');
catalog.addEventListener('click', function () {
  $('#modalFreelanceAddCatalog').modal('show');
  $('#cancelSubmit').on("click", function (e) {
    $('#modalFreelanceAddCatalog').modal('hide');
    clearInputs();
  });
});


var edit = document.getElementById('editFreelanceAcc');
edit.addEventListener('click', function () {
  $('#modalEditAccount').modal('show');
  $('#cancelEdit').on("click", function (e) {
    $('#modalEditAccount').modal('hide');
  });
});






//==FOR EDIT CATALOG MODAL=====================================


//for image upload in EDIT CATALOG MODAL
function catalogEditImgUp(event) {
  reader.onload = function () {
    var uploadedImageEditCatalog = document.getElementById('uploadedEditImageCatalog');
    uploadedImageEditCatalog.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}

function edit_catalog() {
  // var editCatalog = document.getElementById('editCatalogBtn');
  const title = document.getElementById('catalogTitleEdit');
  //title.value = catalog_id;
  $('#modalFreelanceEditCatalog').modal('show');

  $('#cancelEditCatalog').on("click", function (e) {
    $('#modalFreelanceEditCatalog').modal('hide');
  });
  //let catalogId = editCatalog.getAttribute('data-parameter');
  /*editCatalog.addEventListener('click', function () {
    
    
  });*/
}

function clearEditModal(){
  var img = document.getElementById('uploadedEditImageCatalog');
  var imgfile = document.getElementById('editInput');
  var title = document.getElementById('edit-catalot-title');
  var desc = document.getElementById('edit-catalog-desc');
  
  // Reset the image input
  imgfile.value = null;
  img.src = '../img/uploadIMG.png';

  // Reset the title and description inputs
  title.value = '';
  desc.value = '';

}

function getConsole(catalogId) {
  console.log(catalogId);
}

