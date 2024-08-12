
  window.onload = function() {
    // Pega todos os elementos correspondentes
    var copyTextareaBtn = Array.prototype.slice.
      call(document.querySelectorAll('.js-textareacopybtn'));
    var copyTextarea = Array.prototype.slice.
      call(document.querySelectorAll('.js-copytextarea'));
 
    // Laço para percorrer todos os elementos
    copyTextareaBtn.forEach(function(btn, idx) {
 
      btn.addEventListener("click", function() {
 
        // Copia o conteudo do textarea
        copyTextarea[idx].select();
 
          var msg = document.execCommand('copy') 
            ? 'funcionou' : 'deu erro';
          console.log('Compando para copiar texto ' + msg);
 
      });
 
    });
  }
