//Validate Photo
$('#photo').change(function(event) {
  var extension=$('#photo').val().replace(/^.*\./, '');
  var _size = this.files[0].size;
  var e_size = _size/1024;
  if (extension=='png' || extension=='jpg' || extension=='jpeg' || extension=='PNG' || extension=='jpg' || extension=='JPEG') {
    $('#photoError').empty();
   if (e_size > 10000) {
     $('#photoError').append('<b>Error:</b> Upload only less than 10MB image');
     $('#photo').val('');
    }
    else{
      $('#photo').css('border','none !important');
    }
  }
  else{
    $('#photoError').empty();
    $('#photoError').append('<b>Error:</b> Upload Only jpg/png Image');
     $('#photo').val('');
  }
});



// Validate Video
$('#video').change(function(event) {
  var extension=$('#video').val().replace(/^.*\./, '');
  var _size = this.files[0].size;
  var e_size = _size/1024;
  if (extension=='mp4' || extension=='MP4') {
    $('#videoError').empty();
   if (e_size > 20000) {
     $('#videoError').append('<b>Error:</b> Upload only less than 20MB video');
     $('#video').val('');
    }
    else{
      $('#video').css('border','none !important');
    }
  }
  else{
    $('#videoError').empty();
    $('#videoError').append('<b>Error:</b> Upload Only MP4 Video');
     $('#video').val('');
  }
});


//Scroll To Required input
var elements = document.querySelectorAll('input,select,textarea');
for (var i = elements.length; i--;) {
    elements[i].addEventListener('invalid', function () {
        this.scrollIntoView(false);
    });
}

