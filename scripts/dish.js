$(document).ready(function () {
  var pointer = 0;
  // var dots = document.getElementsByClassName("slide_dots");

  function moveleft() {
    var t = ".slide_dot:nth-child(" + (pointer + 1) + ")";
    $(t).removeClass("selected_dot");
    pointer = (pointer - 1 < 0) ? (image_sources.length - 1) : (pointer - 1);
    $("#slide_image").attr("src", image_sources[pointer]);
    t = ".slide_dot:nth-child(" + (pointer + 1) + ")";
    $(t).addClass("selected_dot");
  }

  function moveright() {
    var t = ".slide_dot:nth-child(" + (pointer + 1) + ")";
    $(t).removeClass("selected_dot");
    pointer = (pointer + 1) % image_sources.length;
    $("#slide_image").attr("src", image_sources[pointer]);
    t = ".slide_dot:nth-child(" + (pointer + 1) + ")";
    $(t).addClass("selected_dot");
  }

  $(document).keydown(function (e) {
    if (e.key == "ArrowLeft") moveleft();
    if (e.key == "ArrowRight") moveright();
  });

  $("#slide_prev").click(function () {
    moveleft();
  });

  $("#slide_next").click(function () {
    moveright();
    this
  });

  $(".slide_dot").click(function () {
    var t = ".slide_dot:nth-child(" + (pointer + 1) + ")";
    $(t).removeClass("selected_dot");
    pointer = $(this).index();
    $("#slide_image").attr("src", image_sources[pointer]);
    t = ".slide_dot:nth-child(" + (pointer + 1) + ")";
    $(t).addClass("selected_dot");
  });

});
