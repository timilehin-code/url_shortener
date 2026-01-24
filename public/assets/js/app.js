const shortLink = document.querySelector("#short_link");
const copyBtn = document.querySelector(".copyBtn");
const notification = document.querySelector(".notification");
const errorNotification = document.querySelector(".notification-error");
if (shortLink && copyBtn && notification) {
  copyBtn.addEventListener("click", function () {
    navigator.clipboard.writeText(shortLink.value).then(function () {
      copyBtn.textContent = "Copied!";
      notification.classList.add("active");
      setTimeout(() => {
        copyBtn.innerHTML =
          '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-copy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667l0 -8.666" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>';
        notification.classList.remove("active");
      }, 2000);
    });
  });
}else{
    console.warn("elements not found");
}

if (!errorNotification) {
  console.warn("no error notification found");
}else{
  setTimeout(() => {
    errorNotification.classList.remove("active");
  }, 2500);
}
