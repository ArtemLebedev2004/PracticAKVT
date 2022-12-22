
let id = null;


async function getPost() {
    let res = await fetch("http://LebedevRP31Api.ru/posts");
    let posts = await res.json();
    // console.log(posts[0].title);

    let postList = document.getElementsByClassName("post-list")[0];
    postList.innerHTML = '';
    posts.forEach(post => {
        postList.innerHTML += `
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">${post.title}</h5>
                <p class="card-text">${post.body}</p>
                <a href="#" class="card-link">Подробнее</a>
                <a href="#" class="card-link" onclick="removePost(${post.id})">Удалить пост</a>
                <a href="#" class="card-link" onclick="selectPost('${post.id}', '${post.title}', '${post.body}')">Редактировать</a>
            </div>
        </div>
        `    
    });
    
}

async function addPost() {
    let title = document.querySelector('#title').value;
    let body = document.querySelector('#body').value;
    const formData = new FormData();
    formData.append('title', title);
    formData.append('body', body);

    const res = await fetch("http://LebedevRP31Api.ru/posts", {
        method: "POST",
        body: formData
    });
    
    let data = await res.json();

    if (data.status === true) {
        await getPost();
    }
    console.log(data);
}



async function removePost(id){
    const res = await fetch(`http://LebedevRP31Api.ru/posts/${id}`, {
        method: 'DELETE'
        });
        const data = await res.json()
        if (data.status === true) {
            await getPost();
        }
    
}


 function selectPost(id, title, body){
    id=id;
    document.getElementById('title-edit').value = title;
    document.getElementById('body-edit').value = body;
}

async function updatePost(){
    const title = document.getElementById('title-edit').value;
    const body = document.getElementById('body-edit').value;
    const data = {
        title: title,
        body: body
    }
    const res =  await fetch("http://LebedevRP31Api.ru/posts/${id}", {
        method: 'PATCH',
        body: JSON.stringify(data)
    });
    let resData = await res.json() 
    if (resData.status === true) {
        await getPosts();
    }

}
getPost();