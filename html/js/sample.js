const btn = document.querySelector('a.btn')
btn.addEventListener('click', function (e) {
    const now = new Date()
    console.log(`${now}に a.btngが押されました`)
    alert("aタグのbtnクラスがクリックされたイベントをきっかけにこの表示が出力されています")
})
