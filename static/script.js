const inputElement = document.getElementById("inputElement");
const container = document.getElementById("recipes-container");

inputElement.addEventListener("input", () => {
  const value = inputElement.value.trim();

  fetch("search_recipes.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ query: value })
  })
    .then(res => res.text())
    .then(html => {
      container.innerHTML = html;
    });
});
