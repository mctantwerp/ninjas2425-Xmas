import{g as i}from"./index-DjKJqAo0.js";document.addEventListener("DOMContentLoaded",()=>{const a=document.querySelectorAll(".snow, .gingerman, .candy"),o=document.querySelector(".snow"),c=document.querySelector(".gingerman"),u=document.querySelector(".candy");a.forEach(t=>{t.addEventListener("click",async()=>{await e(t)})});const r=async()=>{let t;t=Math.floor(Math.random()*1501)+2500,await e(o),await n(t),t=Math.floor(Math.random()*1501)+3e3,await e(c),await n(t),t=Math.floor(Math.random()*651)+600,await e(o),await n(t),await e(u),setTimeout(r,5e3)};r()});async function e(a){await i.to(a,{duration:.15,x:3,repeat:4,yoyo:!0,ease:"bounce.inOut"}),await i.to(a,{duration:.15,x:0,ease:"bounce.inOut"})}function n(a){return new Promise(o=>setTimeout(o,a))}
