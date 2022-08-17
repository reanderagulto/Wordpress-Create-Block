(()=>{"use strict";var e,t={683:(e,t,o)=>{const s=window.wp.blocks,l=window.wp.element,a=window.wp.i18n,r=window.wp.blockEditor,n=window.wp.components,c=window.wp.serverSideRender;var i=o.n(c);const m=JSON.parse('{"u2":"create-block/aios-listing-block"}');(0,s.registerBlockType)(m.u2,{edit:function(e){const{className:t,attributes:o,setAttributes:s}=e,c=(0,r.useBlockProps)();return(0,l.createElement)("div",c,(0,l.createElement)(r.InspectorControls,null,(0,l.createElement)(n.PanelBody,{title:(0,a.__)("Listings Settings"),initialOpen:!0,className:"aios-block-container"},(0,l.createElement)("fieldset",{className:"aios-form-group"},(0,l.createElement)("div",{class:"aios-block-col"},(0,l.createElement)("legend",{for:"selectedTheme"},(0,a.__)("Select Theme:","aios-listings"))),(0,l.createElement)("div",{class:"aios-block-col"},(0,l.createElement)(n.SelectControl,{className:"aios-form-control",name:"selectedTheme",id:"selectedTheme",value:o.selected_theme,options:[{label:"Classic",value:"classic"},{label:"Default",value:"default"}],onChange:t=>function(t){e.setAttributes({selected_theme:t})}(t)}))),(0,l.createElement)("fieldset",{className:"aios-form-group"},(0,l.createElement)("div",{class:"aios-block-col"},(0,l.createElement)("legend",{for:"numberOfPost"},(0,a.__)("Number of Post:","aios-listings"))),(0,l.createElement)("div",{class:"aios-block-col"},(0,l.createElement)(n.RangeControl,{value:o.posts_per_page,className:"aios-form-control",name:"numberOfPost",id:"numberOfPost",min:1,max:10,onChange:t=>function(t){e.setAttributes({posts_per_page:t})}(t)}))),(0,l.createElement)("fieldset",{className:"aios-form-group aios-checkbox"},(0,l.createElement)("div",{class:"aios-block-col"},(0,l.createElement)("legend",{for:"numberOfPost"},(0,a.__)("Featured Only?","aios-listings"))),(0,l.createElement)("div",{class:"aios-block-col"},(0,l.createElement)(n.CheckboxControl,{name:"featuredOnly",id:"featuredOnly",className:"aios-form-control",checked:o.featured_only,onChange:t=>function(t){e.setAttributes({featured_only:t})}(t)}))))),(0,l.createElement)("div",{class:"aios-block-preview"},(0,l.createElement)(i(),{block:"create-block/aios-listing-block",attributes:e.attributes})))}})}},o={};function s(e){var l=o[e];if(void 0!==l)return l.exports;var a=o[e]={exports:{}};return t[e](a,a.exports,s),a.exports}s.m=t,e=[],s.O=(t,o,l,a)=>{if(!o){var r=1/0;for(m=0;m<e.length;m++){o=e[m][0],l=e[m][1],a=e[m][2];for(var n=!0,c=0;c<o.length;c++)(!1&a||r>=a)&&Object.keys(s.O).every((e=>s.O[e](o[c])))?o.splice(c--,1):(n=!1,a<r&&(r=a));if(n){e.splice(m--,1);var i=l();void 0!==i&&(t=i)}}return t}a=a||0;for(var m=e.length;m>0&&e[m-1][2]>a;m--)e[m]=e[m-1];e[m]=[o,l,a]},s.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return s.d(t,{a:t}),t},s.d=(e,t)=>{for(var o in t)s.o(t,o)&&!s.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},s.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={885:0,573:0};s.O.j=t=>0===e[t];var t=(t,o)=>{var l,a,r=o[0],n=o[1],c=o[2],i=0;if(r.some((t=>0!==e[t]))){for(l in n)s.o(n,l)&&(s.m[l]=n[l]);if(c)var m=c(s)}for(t&&t(o);i<r.length;i++)a=r[i],s.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return s.O(m)},o=self.webpackChunkaios_gutenberg=self.webpackChunkaios_gutenberg||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var l=s.O(void 0,[573],(()=>s(683)));l=s.O(l)})();