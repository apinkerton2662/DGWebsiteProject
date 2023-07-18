
function decrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const maxqty = document.getElementById('data-name').textContent;
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    if (value > 0) {
        value--;
        target.value = value;
    }
  };

  function increment(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const maxqty = document.getElementById('data-name').textContent;
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    if (maxqty > value) {
        value++;
        target.value = value;
    }
  };

  const decrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`
  );

  const incrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`
  );

  decrementButtons.forEach(btn => {
    btn.addEventListener("click", decrement);
  });

  incrementButtons.forEach(btn => {
    btn.addEventListener("click", increment);
  });

if (document.querySelector(".sortby")) {
  document.querySelector(".sortby select").onchange = function() {
      window.location.href = "index.php?page=products&sort=" + this.value;
  };
};