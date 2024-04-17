trad = {
    "en": {
        "titleVoid": "Title cannot be blank",
        "titleEnVoid": "Title in English cannot be blank",
        "articleVoid": "Article cannot be blank",
        "articleEnVoid": "Article in English cannot be blank",
        "categoryVoid": "Category cannot be blank",
        "styleVoid": "Style cannot be blank",
        "madeByVoid": "Made by cannot be blank",
        "linkVoid": "Link cannot be blank",
        "linkCreatorVoid": "Link creator cannot be blank",
        "dateVoid": "You have to set a date",
        "thumbnailVoid": "You have to set an image",
        "format": "The format of the image must be jpeg or png",
        "size": "The size of the image must be less than 2MB"
    },
    "fr": {
        "titleVoid": "Le titre ne peut pas être vide",
        "titleEnVoid": "Le titre en anglais ne peut pas être vide",
        "articleVoid": "L'article ne peut pas être vide",
        "articleEnVoid": "L'article en anglais ne peut pas être vide",
        "categoryVoid": "La catégorie ne peut pas être vide",
        "styleVoid": "Le style ne peut pas être vide",
        "madeByVoid": "Fabriqué par ne peut pas être vide",
        "linkVoid": "Le lien ne peut pas être vide",
        "linkCreatorVoid": "Le lien du créateur ne peut pas être vide",
        "dateVoid": "Tu dois mettre une date",
        "thumbnailVoid": "Tu dois mettre une image",
        "format": "Le format de l'image doit être jpeg ou png",
        "size": "La taille de l'image doit être inférieure à 2MB"
    }
}

const sendDataToServer = async (formData) => {
    const response = await fetch('./admin.php', {
        method: 'POST',
        body: formData
    })
    .catch(error => {
        console.error('Erreur:', error);
    })
    return response;
};


var image;

const form = document.getElementById('form-article-creator');
const imageInput = document.getElementById('thumbnail');

imageInput.addEventListener('change', () => {
    const file = imageInput.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', () => {
        image = reader.result;
    });

    reader.readAsDataURL(file);
});

const verifyCreate = async () => {
    let error = 0;
    const title = document.getElementById('title');
    const titleEn = document.getElementById('titleEn');
    const article = document.getElementById('article');
    const articleEn = document.getElementById('articleEn');
    const category = document.getElementById('category');
    const style = document.getElementById('style');
    const madeBy = document.getElementById('madeBy');
    const link = document.getElementById('link');
    const linkCreator = document.getElementById('linkCreator');
    const date = document.getElementById('date');
    const thumbnail = document.getElementById('thumbnail');

    const titleValue = title.value.trim();
    const titleEnValue = titleEn.value.trim();
    const articleValue = article.value.trim();
    const articleEnValue = articleEn.value.trim();
    const categoryValue = category.value.trim();
    const styleValue = style.value.trim();
    const madeByValue = madeBy.value.trim();
    const linkValue = link.value.trim();
    const linkCreatorValue = linkCreator.value.trim();
    const dateValue = date.value;

    if (titleValue === '') {
        setError(title, trad[lang].titleVoid);
        error =1;
    }
    
    if (title.length > 128) {
        setError(title, trad[lang].titleTooLong);
        error =1;
    }

    if (titleEnValue === '') {
        setError(titleEn, trad[lang].titleEnVoid);
        error =1;
    }

    if (titleEn.length > 128) {
        setError(titleEn, trad[lang].titleEnTooLong);
        error =1;
    }

    if (articleValue === '') {
        setError(article, trad[lang].articleVoid);
        error =1;
    }

    if (articleEnValue === '') {
        setError(articleEn, trad[lang].articleEnVoid);
        error =1;
    }

    if (categoryValue === '') {
        setError(category, trad[lang].categoryVoid);
        error =1;
    }

    if (category.length > 64) {
        setError(category, trad[lang].categoryTooLong);
        error =1;
    }

    if (styleValue === '') {
        setError(style, trad[lang].styleVoid);
        error =1;
    }

    if (style.length > 64) {
        setError(style, trad[lang].styleTooLong);
        error =1;
    }

    if (madeByValue === '') {
        setError(madeBy, trad[lang].madeByVoid);
        error =1;
    }

    if (madeBy.length > 64) {
        setError(madeBy, trad[lang].madeByTooLong);
        error =1;
    }

    if (linkValue === '') {
        setError(link, trad[lang].linkVoid);
        error =1;
    }

    if (link.length > 512) {
        setError(link, trad[lang].linkTooLong);
        error =1;
    }

    if (linkCreatorValue === '') {
        setError(linkCreator, trad[lang].linkCreatorVoid);
        error =1;
    }

    if (linkCreator.length > 512) {
        setError(linkCreator, trad[lang].linkCreatorTooLong);
        error =1;
    }

    if (dateValue === '') {
        setError(date, trad[lang].dateVoid);
        error =1;
    }

    if (thumbnail.files[0] === undefined) {
        setError(thumbnail, trad[lang].thumbnailVoid);
        error =1;
    } else {
        if (thumbnail.files[0].type != 'image/jpeg' && thumbnail.type != 'image/png') {
            setError(thumbnail, trad[lang].format);
            error =1;
        }
    
        if ((thumbnail.files[0].size / (1024 * 1024)) > 2) {
            setError(thumbnail, trad[lang].size);
            error =1;
        }
    }

    if (error == 0) {
        const formData = new FormData();
        formData.append('title', titleValue);
        formData.append('titleEn', titleEnValue);
        formData.append('article', articleValue);
        formData.append('articleEn', articleEnValue);
        formData.append('category', categoryValue);
        formData.append('style', styleValue);
        formData.append('madeBy', madeByValue);
        formData.append('link', linkValue);
        formData.append('linkCreator', linkCreatorValue);
        formData.append('date', dateValue);
        formData.append('thumbnail', image);

        await sendDataToServer(formData);

        location.reload();
    }
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const error = document.getElementsByClassName("error");
    if (error.length !=0) {
        var arr = Array.from(error);
        arr.forEach(element => {
            element.remove();
        });
    }

    verifyCreate();
});