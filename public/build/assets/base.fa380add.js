import{r as u,a as o,c as s,b as e,F as i,e as m,n as p,f as c,g as v,h as _,t as f,i as g,o as h,u as x,j as y,R as b}from"./app.77c39b12.js";const k={class:"landing-navbar"},F=e("div",null,[e("div",{class:"text-xs"},"FIOEP"),_(" Foodia ")],-1),L=e("div",{class:"py-10"},null,-1),N={name:"Navbar",setup(d){const n=u([{text:"Order",to:"/admin/order"},{text:"Product",to:"/admin/product"},{text:"Invoice",to:"/admin/invoice"},{text:"User",to:"/admin/user"},{text:"Login",to:"/login"}]);return(r,t)=>{const l=g("RouterLink");return o(),s(i,null,[e("div",k,[F,e("ul",null,[(o(!0),s(i,null,m(n.value,a=>(o(),s("li",{key:a,class:p(a.to==r.$route.path?"font-semibold":"")},[c(l,{to:a.to},{default:v(()=>[_(f(a.text),1)]),_:2},1032,["to"])],2))),128))])]),L],64)}}};const R={class:""},w={name:"base",setup(d){const n=u({username:"",name:""});async function r(){try{const t=await y.get("/auth/profile");console.log(t),n.value=t.data.data}catch(t){console.log(t)}}return h(()=>{r()}),(t,l)=>(o(),s("div",R,[c(N),c(x(b))]))}};export{w as default};