!function(e){var t={};function n(l){if(t[l])return t[l].exports;var a=t[l]={i:l,l:!1,exports:{}};return e[l].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,l){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(n.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(l,a,function(t){return e[t]}.bind(null,a));return l},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=355)}({1:function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}},10:function(e,t,n){var l=n(14),a=n(21);e.exports=function(e,t){return!t||"object"!==l(t)&&"function"!=typeof t?a(e):t}},11:function(e,t){function n(t){return e.exports=n=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},n(t)}e.exports=n},12:function(e,t,n){var l=n(59);e.exports=function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&l(e,t)}},14:function(e,t){function n(e){return(n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function l(t){return"function"==typeof Symbol&&"symbol"===n(Symbol.iterator)?e.exports=l=function(e){return n(e)}:e.exports=l=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":n(e)},l(t)}e.exports=l},143:function(e,t){e.exports=lodash},21:function(e,t){e.exports=function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}},26:function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},344:function(e,t,n){},345:function(e,t,n){},346:function(e,t,n){},355:function(e,t,n){"use strict";n.r(t);n(344);var l=function(e){var t,n=e.size,l=void 0===n?"24px":n,a=e.color,o=e.className;switch(a){case"white":t="#FFFFFF";break;case"grey":t="#555d66";break;default:t="#66BB6A"}return wp.element.createElement("svg",{id:"Layer_1",width:l,height:l,className:o,xmlns:"http://www.w3.org/2000/svg",xmlnsXlink:"http://www.w3.org/1999/xlink",viewBox:"100 0 404 400"},wp.element.createElement("g",{id:"Layer_2"},wp.element.createElement("circle",{fill:t,cx:"300",cy:"200",r:"200"}),wp.element.createElement("defs",null,wp.element.createElement("circle",{id:"SVGID_1_",cx:"300",cy:"200",r:"200"})),wp.element.createElement("clippath",{id:"SVGID_2_"},wp.element.createElement("use",{xlinkHref:"#SVGID_1_",overflow:"visible"})),wp.element.createElement("path",{clipPath:"url(#SVGID_2_)",fill:"#FFF",d:"M328.5,214.2c0.8,1.8,2.5,3.3,2.5,3.3c35.4,4.3,85.5-0.5,123.7-5.6 c-21.9,47.1-61.1,78.4-96.9,78.4c-67.4,0-119.3-81.7-119.3-81.7c20.9-18.3,55.2-78.4,104.8-78.4s71.2,27.2,71.2,27.2l5.6-8.9 c0,0-23.2-81.2-88.8-81.2S195.9,175.1,155.2,199.7c0,0,56,132.8,178.6,132.8c102.8,0,128.8-98.2,133.6-122.6 c13.7-2,25.2-4.1,32.6-5.3c2.5-5.6,5.3-15.5,3.3-28.8c-41,15.8-103.1,33.6-175.8,33.6C327.2,209.4,327.5,212,328.5,214.2z"})))},a={id:{type:"number"},prevId:{type:"number"},displayStyle:{type:"string",default:"onpage"},continueButtonTitle:{type:"string",default:""},showTitle:{type:"boolean",default:!0},showGoal:{type:"boolean",default:!0},contentDisplay:{type:"boolean",default:!0},showContent:{type:"string",default:"above"}},o=n(38),r=n.n(o),i=n(143);function c(){return wpApiSettings.root.replace("/wp-json/","")}var s=wp.i18n.__,m=function(){return wp.element.createElement("p",{className:"give-blank-slate__help"},"Need help ? Get started with ",wp.element.createElement("a",{href:"http://docs.givewp.com/give101/",target:"_blank",rel:"noopener noreferrer"},s("GiveWP 101")))},u=(n(345),function(){return wp.element.createElement("div",{className:"placeholder-animation"},wp.element.createElement("div",{className:"timeline-wrapper"},wp.element.createElement("div",{className:"timeline-item"},wp.element.createElement("div",{className:"animated-background"},wp.element.createElement("div",{className:"layer label layer-4"},wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"}),wp.element.createElement("div",{className:"layer-item opaque"}),wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"})),wp.element.createElement("div",{className:"layer-gap small"}),wp.element.createElement("div",{className:"layer h2 layer-5"},wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"}),wp.element.createElement("div",{className:"layer-item opaque"}),wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"})),wp.element.createElement("div",{className:"layer-gap medium"}),wp.element.createElement("div",{className:"layer label layer-6"},wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"})),wp.element.createElement("div",{className:"layer-gap small"}),wp.element.createElement("div",{className:"layer h2 layer-7"},wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"})),wp.element.createElement("div",{className:"layer-gap medium"}),wp.element.createElement("div",{className:"layer-gap medium"}),wp.element.createElement("div",{className:"layer h1 layer-8"},wp.element.createElement("div",{className:"layer-item opaque"}),wp.element.createElement("div",{className:"layer-item"}),wp.element.createElement("div",{className:"layer-item opaque"}))))))}),p=(wp.i18n.__,function(e){var t=e.noIcon,n=e.isLoader,a=e.title,o=e.description,r=e.children,i=e.helpLink,c=wp.element.createElement(u,null),s=wp.element.createElement("div",{className:"block-loaded"},!!a&&wp.element.createElement("h2",{className:"give-blank-slate__heading"},a),!!o&&wp.element.createElement("p",{className:"give-blank-slate__message"},o),r,!!i&&wp.element.createElement(m,null));return wp.element.createElement("div",{className:"give-blank-slate"},!t&&wp.element.createElement(l,{size:"80",className:"give-blank-slate__image"}),n?c:s)}),d=wp.i18n.__,w=wp.components.Button,f=function(){return wp.element.createElement(p,{title:d("No donation forms found."),description:d("The first step towards accepting online donations is to create a form."),helpLink:!0},wp.element.createElement(w,{isPrimary:!0,isLarge:!0,className:"give-blank-slate__cta",href:"".concat(c(),"/wp-admin/post-new.php?post_type=give_forms")},d("Create Donation Form")))},h=n(26),v=n.n(h),y=n(1),g=n.n(y),b=n(8),E=n.n(b),C=n(10),_=n.n(C),S=n(11),k=n.n(S),N=n(21),T=n.n(N),x=n(12),D=n.n(x),P=wp.element.Component,F=wp.components.BaseControl,B=function(e){function t(e){var n;return g()(this,t),(n=_()(this,k()(t).call(this,e))).state={},n.saveSetting=n.saveSetting.bind(T()(n)),n.saveState=n.saveState.bind(T()(n)),n}return D()(t,e),E()(t,[{key:"saveSetting",value:function(e,t){this.props.setAttributes(v()({},e,t))}},{key:"saveState",value:function(e,t){this.setState(v()({},e,t))}},{key:"componentDidMount",value:function(){this.$el=jQuery(this.el),this.$input=this.$el.chosen({width:"100%"}).data("chosen"),this.handleChange=this.handleChange.bind(this),this.$el.on("change",this.handleChange)}},{key:"componentWillUnmount",value:function(){this.$el.off("change",this.handleChange),this.$el.chosen("destroy")}},{key:"handleChange",value:function(e){this.props.onChange(e.target.value)}},{key:"componentDidUpdate",value:function(){var e=jQuery(".chosen-base-control").closest(".chosen-container").find(".chosen-search-input");this.$input.search_field.autocomplete({source:function(t,n){var l={action:"give_block_donation_form_search_results",search:t.term};jQuery.post(ajaxurl,l,function(l){jQuery(".give-block-chosen-select").empty(),(l=JSON.parse(l)).length>0&&(n(jQuery.map(l,function(e){jQuery(".give-block-chosen-select").append('<option value="'+e.id+'">'+e.name+"</option>")})),jQuery(".give-block-chosen-select").trigger("chosen:updated"),e.val(t.term))})}})}},{key:"render",value:function(){var e=this;return wp.element.createElement(F,{className:"give-chosen-base-control"},wp.element.createElement("select",{className:"give-select give-select-chosen give-block-chosen-select",ref:function(t){return e.el=t}},this.props.options.map(function(e,t){return wp.element.createElement("option",{key:"".concat(e.label,"-").concat(e.value,"-").concat(t),value:e.value},e.label)})))}}]),t}(P),O=wp.i18n.__,I=wp.data.withSelect,j=wp.components,A=(j.SelectControl,j.Button),G=j.Placeholder,M=j.Spinner,L={value:"0",label:O("-- Select Form --")},q=I(function(e){return{forms:e("core").getEntityRecords("postType","give_forms",{per_page:30})}})(function(e){var t,n=e.forms,l=e.attributes,a=e.setAttributes,o=l.prevId;return n?n&&0===n.length?wp.element.createElement(f,null):wp.element.createElement(p,{title:O("Donation Form")},wp.element.createElement(B,{className:"give-blank-slate__select",options:(t=[],Object(i.isUndefined)(n)||(t=n.map(function(e){var t=e.id,n=e.title.rendered;return{value:t,label:""===n?"".concat(t," : ").concat(O("No form title")):n}})),t.unshift(L),t),onChange:function(e){a({id:Number(e)})}}),wp.element.createElement(A,{isPrimary:!0,isLarge:!0,href:"".concat(c(),"/wp-admin/post-new.php?post_type=give_forms")},O("Add New Form")),"  ",o&&wp.element.createElement(A,{isLarge:!0,onClick:function(){a({id:Number(o)}),a({prevId:void 0})}},O("Cancel"))):wp.element.createElement(G,null,wp.element.createElement(M,null))}),R=wp.i18n.__,W={};W.displayStyles=[{value:"onpage",label:R("Full Form")},{value:"modal",label:R("Modal")},{value:"reveal",label:R("Reveal")},{value:"button",label:R("One Button Launch")}],W.contentPosition=[{value:"above",label:R("Above")},{value:"below",label:R("Below")}];var z=W,Q=wp.i18n.__,$=wp.blockEditor.InspectorControls,V=wp.components,U=V.PanelBody,H=V.SelectControl,J=V.ToggleControl,X=V.TextControl,K=function(e){function t(e){var n;return g()(this,t),(n=_()(this,k()(t).call(this,e))).state={continueButtonTitle:n.props.attributes.continueButtonTitle},n.saveSetting=n.saveSetting.bind(T()(n)),n.saveState=n.saveState.bind(T()(n)),n}return D()(t,e),E()(t,[{key:"saveSetting",value:function(e,t){this.props.setAttributes(v()({},e,t))}},{key:"saveState",value:function(e,t){this.setState(v()({},e,t))}},{key:"render",value:function(){var e=this,t=this.props.attributes,n=t.displayStyle,l=t.showTitle,a=t.showGoal,o=t.showContent,r=t.contentDisplay;return wp.element.createElement($,{key:"inspector"},wp.element.createElement(U,{title:Q("Display")},wp.element.createElement(H,{label:Q("Form Format"),name:"displayStyle",value:n,options:z.displayStyles,onChange:function(t){return e.saveSetting("displayStyle",t)}}),"reveal"===n&&wp.element.createElement(X,{name:"continueButtonTitle",label:Q("Continue Button Title"),value:this.state.continueButtonTitle,onChange:function(t){return e.saveState("continueButtonTitle",t)},onBlur:function(t){return e.saveSetting("continueButtonTitle",t.target.value)}})),wp.element.createElement(U,{title:Q("Settings")},wp.element.createElement(J,{label:Q("Title"),name:"showTitle",checked:!!l,onChange:function(t){return e.saveSetting("showTitle",t)}}),wp.element.createElement(J,{label:Q("Goal"),name:"showGoal",checked:!!a,onChange:function(t){return e.saveSetting("showGoal",t)}}),wp.element.createElement(J,{label:Q("Content"),name:"contentDisplay",checked:!!r,onChange:function(t){return e.saveSetting("contentDisplay",t)}}),r&&wp.element.createElement(H,{label:Q("Content Position"),name:"showContent",value:o,options:z.contentPosition,onChange:function(t){return e.saveSetting("showContent",t)}})))}}]),t}(wp.element.Component),Y=(n(346),wp.i18n.__),Z=function(e){return wp.element.createElement("div",{className:"give-block-controls"},wp.element.createElement("div",{className:"control-popup"},wp.element.createElement("div",{className:"control-button change-form",onClick:function(){e.setAttributes({prevId:e.attributes.id}),e.setAttributes({id:0})}},wp.element.createElement("div",null,wp.element.createElement("span",{className:"dashicons dashicons-image-rotate"}),wp.element.createElement("span",null,Y("Change Form")))),wp.element.createElement("a",{className:"control-button edit-form",href:"".concat(c(),"/wp-admin/post.php?post=").concat(e.attributes.id,"&action=edit"),target:"_blank",rel:"noopener noreferrer",tooltip:Y("Edit donation form")},wp.element.createElement("div",null,wp.element.createElement("span",{className:"dashicons dashicons-edit"}),wp.element.createElement("span",null,Y("Edit Form"))))))},ee=wp.components.ServerSideRender,te=function(e){var t=e.attributes,n=e.isSelected,l=e.className;return t.id?wp.element.createElement("div",{className:n?"".concat(l," isSelected"):l},wp.element.createElement(K,r()({},e)),wp.element.createElement(Z,r()({},e)),wp.element.createElement(ee,{block:"give/donation-form",attributes:t})):wp.element.createElement(q,r()({},e))},ne=wp.i18n.__,le=((0,wp.blocks.registerBlockType)("give/donation-form",{title:ne("Donation Form"),description:ne("The GiveWP Donation Form block inserts an existing donation form into the page. Each donation form's presentation can be customized below."),category:"give",icon:wp.element.createElement(l,{color:"grey"}),keywords:[ne("donation")],supports:{html:!1},attributes:a,edit:te,save:function(){return null}}),{formsPerPage:{type:"string",default:"12"},formIDs:{type:"string",default:""},excludedFormIDs:{type:"string",default:""},orderBy:{type:"string",default:"date"},order:{type:"string",default:"DESC"},categories:{type:"string",default:""},tags:{type:"string",default:""},columns:{type:"string",default:"best-fit"},showTitle:{type:"boolean",default:!0},showExcerpt:{type:"boolean",default:!0},showGoal:{type:"boolean",default:!0},showFeaturedImage:{type:"boolean",default:!0},displayType:{type:"string",default:"redirect"}}),ae=wp.i18n.__,oe={};oe.orderBy=[{value:"date",label:ae("Date Created")},{value:"name",label:ae("Form Name")},{value:"amount_donated",label:ae("Amount Donated")},{value:"number_donations",label:ae("Number of Donations")},{value:"menu_order",label:ae("Menu Order")},{value:"post__in",label:ae("Provided Form IDs")},{value:"closest_to_goal",label:ae("Closest To Goal")}],oe.order=[{value:"DESC",label:ae("Descending")},{value:"ASC",label:ae("Ascending")}],oe.columns=[{value:"best-fit",label:ae("Best Fit")},{value:"1",label:"1"},{value:"2",label:"2"},{value:"3",label:"3"},{value:"4",label:"4"}],oe.displayType=[{value:"redirect",label:ae("Redirect")},{value:"modal_reveal",label:ae("Modal")}];var re=oe,ie=wp.i18n.__,ce=wp.blockEditor.InspectorControls,se=wp.components,me=se.PanelBody,ue=se.SelectControl,pe=se.ToggleControl,de=se.TextControl,we=function(e){var t=e.attributes,n=e.setAttributes,l=t.formsPerPage,a=t.formIDs,o=t.excludedFormIDs,r=t.orderBy,i=t.order,c=t.categories,s=t.tags,m=t.columns,u=t.showTitle,p=t.showExcerpt,d=t.showGoal,w=t.showFeaturedImage,f=t.displayType,h=function(e,t){n(v()({},e,t))};return wp.element.createElement(ce,{key:"inspector"},wp.element.createElement(me,{title:ie("Form Grid Settings")},wp.element.createElement(de,{name:"formsPerPage",label:ie("Forms Per Page"),value:l,onChange:function(e){return h("formsPerPage",e)}}),wp.element.createElement(de,{name:"formIDs",label:ie("Form IDs"),value:a,onChange:function(e){return h("formIDs",e)}}),wp.element.createElement(de,{name:"excludedFormIDs",label:ie("Excluded Form IDs"),value:o,onChange:function(e){return h("excludedFormIDs",e)}}),wp.element.createElement(ue,{label:ie("Order By"),name:"orderBy",value:r,options:re.orderBy,onChange:function(e){return h("orderBy",e)}}),wp.element.createElement(ue,{label:ie("Order"),name:"order",value:i,options:re.order,onChange:function(e){return h("order",e)}}),wp.element.createElement(de,{name:"categories",label:ie("Categories"),value:c,onChange:function(e){return h("categories",e)}}),wp.element.createElement(de,{name:"tags",label:ie("Tags"),value:s,onChange:function(e){return h("tags",e)}}),wp.element.createElement(ue,{label:ie("Columns"),name:"columns",value:m,options:re.columns,onChange:function(e){return h("columns",e)}}),wp.element.createElement(pe,{name:"showTitle",label:ie("Show Title"),checked:!!u,onChange:function(e){return h("showTitle",e)}}),wp.element.createElement(pe,{name:"showExcerpt",label:ie("Show Excerpt"),checked:!!p,onChange:function(e){return h("showExcerpt",e)}}),wp.element.createElement(pe,{name:"showGoal",label:ie("Show Goal"),checked:!!d,onChange:function(e){return h("showGoal",e)}}),wp.element.createElement(pe,{name:"showFeaturedImage",label:ie("Show Featured Image"),checked:!!w,onChange:function(e){return h("showFeaturedImage",e)}}),wp.element.createElement(ue,{label:ie("Display Type"),name:"displayType",value:f,options:re.displayType,onChange:function(e){return h("displayType",e)}})))},fe=(wp.i18n.__,wp.element.Fragment),he=wp.components.ServerSideRender,ve=(0,wp.data.withSelect)(function(e){return{forms:e("core").getEntityRecords("postType","give_forms")}})(function(e){var t=e.attributes;return wp.element.createElement(fe,null,wp.element.createElement(we,r()({},e)),wp.element.createElement(he,{block:"give/donation-form-grid",attributes:t}))}),ye=wp.i18n.__,ge=((0,wp.blocks.registerBlockType)("give/donation-form-grid",{title:ye("Donation Form Grid"),description:ye("The GiveWP Donation Form Grid block insert an existing donation form into the page. Each form's presentation can be customized below."),category:"give",icon:wp.element.createElement(l,{color:"grey"}),keywords:[ye("donation"),ye("grid")],supports:{html:!1},attributes:le,edit:ve,save:function(){return null}}),wp.i18n.__),be={donorsPerPage:{type:"string",default:"12"},formID:{type:"string",default:"0"},orderBy:{type:"string",default:"post_date"},order:{type:"string",default:"DESC"},paged:{type:"string",default:"1"},columns:{type:"string",default:"best-fit"},showAvatar:{type:"boolean",default:!0},showName:{type:"boolean",default:!0},showTotal:{type:"boolean",default:!0},showDate:{type:"boolean",default:!0},showComments:{type:"boolean",default:!0},showAnonymous:{type:"boolean",default:!0},onlyComments:{type:"boolean",default:!1},commentLength:{type:"string",default:"140"},readMoreText:{type:"string",default:ge("Read more")},loadMoreText:{type:"string",default:ge("Load more")},avatarSize:{type:"string",default:"60"}},Ee=wp.i18n.__,Ce={};Ce.columns=[{value:"best-fit",label:Ee("Best Fit")},{value:"1",label:"1"},{value:"2",label:"2"},{value:"3",label:"3"},{value:"4",label:"4"}],Ce.order=[{value:"DESC",label:Ee("Descending")},{value:"ASC",label:Ee("Ascending")}],Ce.orderBy=[{value:"donation_amount",label:Ee("Donation Amount")},{value:"post_date",label:Ee("Date Created")}];var _e=Ce,Se=wp.i18n.__,ke=wp.blockEditor.InspectorControls,Ne=wp.components,Te=Ne.PanelBody,xe=Ne.SelectControl,De=Ne.ToggleControl,Pe=Ne.TextControl,Fe=function(e){var t=e.attributes,n=e.setAttributes,l=t.donorsPerPage,a=t.formID,o=t.orderBy,r=t.order,i=t.columns,c=t.showAvatar,s=t.showName,m=t.showTotal,u=t.showDate,p=t.showComments,d=t.showAnonymous,w=t.onlyComments,f=t.commentLength,h=t.readMoreText,y=t.loadMoreText,g=function(e,t){n(v()({},e,t))};return wp.element.createElement(ke,{key:"inspector"},wp.element.createElement(Te,{title:Se("Donor Wall Settings")},wp.element.createElement(Pe,{name:"donorsPerPage",label:Se("Donors Per Page"),value:l,onChange:function(e){return g("donorsPerPage",e)}}),wp.element.createElement(Pe,{name:"formID",label:Se("Form ID"),value:a,onChange:function(e){return g("formID",e)}}),wp.element.createElement(xe,{label:Se("Order By"),name:"orderBy",value:o,options:_e.orderBy,onChange:function(e){return g("orderBy",e)}}),wp.element.createElement(xe,{label:Se("Order"),name:"order",value:r,options:_e.order,onChange:function(e){return g("order",e)}}),wp.element.createElement(xe,{label:Se("Columns"),name:"columns",value:i,options:_e.columns,onChange:function(e){return g("columns",e)}}),wp.element.createElement(De,{name:"showAvatar",label:Se("Show Avatar"),checked:!!c,onChange:function(e){return g("showAvatar",e)}}),wp.element.createElement(De,{name:"showName",label:Se("Show Name"),checked:!!s,onChange:function(e){return g("showName",e)}}),wp.element.createElement(De,{name:"showTotal",label:Se("Show Total"),checked:!!m,onChange:function(e){return g("showTotal",e)}}),wp.element.createElement(De,{name:"showDate",label:Se("Show Time"),checked:!!u,onChange:function(e){return g("showDate",e)}}),wp.element.createElement(De,{name:"showComments",label:Se("Show Comments"),checked:!!p,onChange:function(e){return g("showComments",e)}}),wp.element.createElement(De,{name:"showAnonymous",label:Se("Show Anonymous"),checked:!!d,onChange:function(e){return g("showAnonymous",e)}}),wp.element.createElement(De,{name:"onlyComments",label:Se("Only Donors with Comments"),checked:!!w,onChange:function(e){return g("onlyComments",e)}}),wp.element.createElement(Pe,{name:"commentLength",label:Se("Comment Length"),value:f,onChange:function(e){return g("commentLength",e)}}),wp.element.createElement(Pe,{name:"readMoreText",label:Se("Read More Text"),value:h,onChange:function(e){return g("readMoreText",e)}}),wp.element.createElement(Pe,{name:"loadMoreText",label:Se("Load More Text"),value:y,onChange:function(e){return g("loadMoreText",e)}})))},Be=wp.element.Fragment,Oe=wp.components.ServerSideRender,Ie=function(e){var t=e.attributes;return wp.element.createElement(Be,null,wp.element.createElement(Fe,r()({},e)),wp.element.createElement(Oe,{block:"give/donor-wall",attributes:t}))},je=wp.i18n.__;(0,wp.blocks.registerBlockType)("give/donor-wall",{title:je("Donor Wall"),description:je("The GiveWP Donor Wall block inserts an existing donation form into the page. Each form's presentation can be customized below."),category:"give",icon:wp.element.createElement(l,{color:"grey"}),keywords:[je("donation"),je("wall")],supports:{html:!1},attributes:be,edit:Ie,save:function(){return null}})},38:function(e,t,n){var l=n(26);e.exports=function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},a=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(a=a.concat(Object.getOwnPropertySymbols(n).filter(function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable}))),a.forEach(function(t){l(e,t,n[t])})}return e}},59:function(e,t){function n(t,l){return e.exports=n=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},n(t,l)}e.exports=n},8:function(e,t){function n(e,t){for(var n=0;n<t.length;n++){var l=t[n];l.enumerable=l.enumerable||!1,l.configurable=!0,"value"in l&&(l.writable=!0),Object.defineProperty(e,l.key,l)}}e.exports=function(e,t,l){return t&&n(e.prototype,t),l&&n(e,l),e}}});