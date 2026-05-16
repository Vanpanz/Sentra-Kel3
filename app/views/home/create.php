<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Event</title>
</head>

<body class="bg-[#E0F7F1] min-h-screen p-8">

    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-8">

            <a href="/homepage"
               class="text-[#45B39D] font-bold flex items-center gap-2 hover:opacity-70 transition">

                <span class="text-xl">&larr;</span>
                Back to Homepage

            </a>

            <h1 class="text-3xl font-black text-gray-700">
                Create Event
            </h1>

        </div>

        <!-- FORM -->
        <form action="/create-event"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            <!-- TITLE -->
            <div>

                <label class="block font-bold text-gray-600 mb-2">
                    Event Title
                </label>

                <input type="text"
                       name="title"
                       required
                       placeholder="Masukkan judul event"
                       class="w-full border border-gray-200 rounded-2xl p-4 outline-none focus:border-[#45B39D]">

            </div>

            <!-- CONTENT -->
            <div>

                <label class="block font-bold text-gray-600 mb-2">
                    Description
                </label>

                <textarea name="content"
                          rows="6"
                          required
                          placeholder="Masukkan deskripsi event"
                          class="w-full border border-gray-200 rounded-2xl p-4 outline-none focus:border-[#45B39D]"></textarea>

            </div>

            <!-- IMAGE -->
            <div>

                <label class="block font-bold text-gray-600 mb-2">
                    Upload Banner
                </label>

                <input type="file"
                       name="gambar"
                       accept="image/*"
                       class="w-full border border-gray-200 rounded-2xl p-4">

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end">

                <button type="submit"
                        class="bg-[#45B39D] hover:bg-[#379683] text-white px-8 py-3 rounded-2xl font-black transition-all">

                    Create Event

                </button>

            </div>

        </form>

    </div>

</body>
</html>