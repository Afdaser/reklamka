( function ( wp ) {
// Компоненти редактора.
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { Fragment, useEffect } = wp.element;
const {
InspectorControls,
MediaUpload,
MediaUploadCheck,
MediaPlaceholder,
BlockControls,
AlignmentToolbar,
} = wp.blockEditor || wp.editor;
const { PanelBody, ToggleControl, RangeControl, Button, ToolbarGroup } = wp.components;

// Реєстрація блоку галереї.
registerBlockType( 'gsb/gallery-slider', {
title: __( 'Слайдер галереї', 'gsb' ),
description: __( 'Акуратний слайдер із великим фото та мініатюрами.', 'gsb' ),
icon: 'format-gallery',
category: 'media',
attributes: {
images: {
type: 'array',
default: [],
},
sliderId: {
type: 'string',
default: '',
},
autoplay: {
type: 'boolean',
default: false,
},
interval: {
type: 'number',
default: 5000,
},
alignment: {
type: 'string',
default: 'center',
},
},

edit: ( props ) => {
const { attributes, setAttributes, className } = props;
const { images, sliderId, autoplay, interval, alignment } = attributes;

// Генеруємо унікальний ID один раз.
useEffect( () => {
if ( ! sliderId ) {
setAttributes( { sliderId: 'gsb-' + Date.now().toString( 36 ) + Math.floor( Math.random() * 1000 ) } );
}
}, [ sliderId ] );

// Оновлення вибраних зображень.
const onSelectImages = ( media ) => {
const selected = media.map( ( item ) => ( {
id: item.id,
url: item.sizes && item.sizes.large ? item.sizes.large.url : item.url,
thumb: item.sizes && item.sizes.thumbnail ? item.sizes.thumbnail.url : item.url,
alt: item.alt || item.title || '',
} ) );
setAttributes( { images: selected } );
};

// Рендер превʼю слайдера в редакторі.
const renderPreview = () => {
if ( ! images.length ) {
return (
<MediaPlaceholder
labels={ { title: __( 'Додати зображення до слайдера', 'gsb' ) } }
icon="format-gallery"
onSelect={ onSelectImages }
allowedTypes={ [ 'image' ] }
multiple
/>
);
}

return (
<div className={ `gsb-slider align${ alignment } ${ className || '' }` } data-slider-id={ sliderId }>
<div className="gsb-main shadow rounded-lg overflow-hidden position-relative">
<button className="gsb-nav gsb-prev btn btn-light">‹</button>
<img className="gsb-active-image img-fluid" src={ images[ 0 ].url } alt={ images[ 0 ].alt } />
<button className="gsb-nav gsb-next btn btn-light">›</button>
</div>
<div className="gsb-thumbs d-flex flex-row align-items-center mt-3">
{ images.map( ( image, index ) => (
<div key={ image.id || index } className="gsb-thumb-wrapper">
<img
src={ image.thumb || image.url }
alt={ image.alt }
className={ `gsb-thumb img-fluid ${ 0 === index ? 'active' : '' }` }
data-full={ image.url }
/>
</div>
) ) }
</div>
</div>
);
};

return (
<Fragment>
<BlockControls>
<ToolbarGroup>
<MediaUploadCheck>
<MediaUpload
onSelect={ onSelectImages }
allowedTypes={ [ 'image' ] }
gallery
multiple
render={ ( { open } ) => (
<Button className="components-button is-primary" onClick={ open }>
{ __( 'Замінити зображення', 'gsb' ) }
</Button>
) }
/>
</MediaUploadCheck>
</ToolbarGroup>
<AlignmentToolbar
value={ alignment }
onChange={ ( nextAlign ) => setAttributes( { alignment: nextAlign || 'center' } ) }
/>
</BlockControls>

<InspectorControls>
<PanelBody title={ __( 'Налаштування слайдера', 'gsb' ) } initialOpen>
<ToggleControl
label={ __( 'Автопрокрутка', 'gsb' ) }
checked={ autoplay }
onChange={ ( value ) => setAttributes( { autoplay: value } ) }
/>
<RangeControl
label={ __( 'Інтервал автопрокрутки (мс)', 'gsb' ) }
value={ interval }
onChange={ ( value ) => setAttributes( { interval: value || 5000 } ) }
min={ 2000 }
max={ 12000 }
step={ 500 }
/>
</PanelBody>
</InspectorControls>

{ renderPreview() }
</Fragment>
);
},

save: ( props ) => {
const { images, sliderId, autoplay, interval, alignment } = props.attributes;

if ( ! images.length ) {
return null;
}

return (
<div
className={ `gsb-slider align${ alignment }` }
data-slider-id={ sliderId }
data-autoplay={ autoplay }
data-interval={ interval }
>
<div className="gsb-main shadow rounded-lg overflow-hidden position-relative">
<button className="gsb-nav gsb-prev btn btn-light">‹</button>
<img className="gsb-active-image img-fluid" src={ images[ 0 ].url } alt={ images[ 0 ].alt } />
<button className="gsb-nav gsb-next btn btn-light">›</button>
</div>
<div className="gsb-thumbs d-flex flex-row align-items-center mt-3">
{ images.map( ( image, index ) => (
<div key={ image.id || index } className="gsb-thumb-wrapper">
<img
src={ image.thumb || image.url }
alt={ image.alt }
className={ `gsb-thumb img-fluid ${ 0 === index ? 'active' : '' }` }
data-full={ image.url }
/>
</div>
) ) }
</div>
</div>
);
},
} );
}( window.wp ) );
