function drop_doldur()
{
  $("#ld").show();
  $.ajax({
    type: "POST",
    url: "ajax_drop_down.aspx/getir",
    data: "{}",
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(msg){
      //dropdownlistimizi dolduruyoruz.(select tagı ile başlıyor ve seçenekler option ile belirtiliyor)
      // <select id="dropdownlist"></select> dropdownlist'imizin html kodu
      $("#dropdownlist").append("<option value='0'>Okumak için Rss Seçiniz...</option>");
      $.each(msg.d, function(i){
        $("#dropdownlist").append("<option value='" + this.adres + "'>" + this.site + "</option>");
      });
      $("#ld").hide();
    }
  });
}