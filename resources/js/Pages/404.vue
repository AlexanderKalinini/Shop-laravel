<template>
    <main
        class="py-16 md:flex md:min-h-screen md:items-center md:justify-center lg:py-20"
    >
        <div class="container">
            <h1 class="text-center text-2xl font-black">Ошибка 404</h1>
            <p class="mx-auto mt-4 max-w-[720px] text-center text-body">
                Похоже, что данная страница не найдена, вы можете вернуться на
                главную страницу.
            </p>
            <div class="mt-8 text-center">
                <router-link to="/" class="btn btn-pink" rel="home"
                    >Вернутся на главную</router-link
                >
            </div>
        </div>
    </main>
</template>
