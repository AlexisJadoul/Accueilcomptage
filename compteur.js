function inc(element) {
  const el = document.querySelector(`[name="${element}"]`);
  const current = parseInt(el.value) || 0;
  el.value = current + 1;
}





