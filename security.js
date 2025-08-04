// Block right-click (prevents "Inspect Element")
document.addEventListener("contextmenu", (e) => e.preventDefault());

// Block F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
document.addEventListener("keydown", (e) => {
    if (
        e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && e.key === "I") ||
        (e.ctrlKey && e.shiftKey && e.key === "J") ||
        (e.ctrlKey && e.key === "U")
    ) {
        e.preventDefault();
        alert("Inspection is disabled.");
    }
});

                    //diasble the page 

                    //setInterval(function() {
                        //if (document.documentMode || /webkit/i.test(navigator.userAgent) || /firefox/i.test(navigator.userAgent)) {
                            //if (window.outerHeight - window.innerHeight > 100 || window.outerWidth - window.innerWidth > 100) {
                               // document.body.innerHTML = ''; window.close();
                            //}
                        //}
                        //, 1000);
                        // Override console methods
// Check if DevTools is open (works in Chrome, Edge, Firefox)
setInterval(() => {
    const widthThreshold = window.outerWidth - window.innerWidth > 150;
    const heightThreshold = window.outerHeight - window.innerHeight > 150;
    
    if (widthThreshold || heightThreshold) {
        // DevTools detected - take action
        document.body.innerHTML = `
            <h1>Developer Tools Detected</h1>
            <p>This page does not allow inspection.</p>
            <p>Redirecting in <span id="countdown">5</span> seconds...</p>
        `;
        
        // Auto-reload after 5 seconds
        let count = 5;
        setInterval(() => {
            count--;
            document.getElementById("countdown").textContent = count;
            if (count <= 0) window.location.reload();
        }, 1000);
    }
}, 1000);     

// Break debugger attempts in Sources tab
(function() {
  function debuggerDetector() {
    const startTime = Date.now();
    (function() {
      debugger;
      const endTime = Date.now();
      if (endTime - startTime > 100) {
        // Debugger detected
        document.body.innerHTML = '<h1>Debugging Not Allowed</h1>';
        window.stop();
      }
    })();
  }
  
  setInterval(debuggerDetector, 1000);
})();

module.exports = {
  productionSourceMap: false,
  devtool: 'none'
  // ...
}
// Instead of static script tags, load JavaScript dynamically
(function() {
  function loadProtectedScript(encodedScript) {
    const script = document.createElement('script');
    script.textContent = atob(encodedScript);
    document.head.appendChild(script).remove();
  }
  
  // Your main code would be base64 encoded
  const protectedCode = '/* Your base64 encoded script here */';
  loadProtectedScript(protectedCode);
  
  // Remove original script tags
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('script:not([data-protected])').forEach(script => {
      script.remove();
    });
  });
})();

(async function() {
  const response = await fetch('protected-functions.wasm');
  const bytes = await response.arrayBuffer();
  const module = await WebAssembly.instantiate(bytes);
  
  // Use your protected functions
  window.sensitiveOperation = module.exports.sensitiveOperation;
})();

// Detect DevTools opening
setInterval(() => {
  if (window.outerWidth - window.innerWidth > 200 || 
      window.outerHeight - window.innerHeight > 200) {
    document.body.innerHTML = 'DevTools detected!';
    window.location.reload();
  }
}, 1000);