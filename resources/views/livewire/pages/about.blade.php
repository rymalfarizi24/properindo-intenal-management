    @section('meta_description', 'Learn about Artikula, our vision, values, and mission to create an accessible digital
        reading space that encourages critical thinking and meaningful exploration.')

        <main class="bg-neutral-100 text-gray-800">

            <!-- Hero Section -->
            <section class="bg-white border-b">
                <div class="max-w-5xl mx-auto px-6 py-20 text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        About Artikula
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                        Artikula is a digital reading space that brings together informative
                        and relevant articles to promote literacy and critical thinking.
                    </p>
                </div>
            </section>

            <!-- Main Content -->
            <section class="max-w-5xl mx-auto px-6 py-16 space-y-16">

                <!-- What is Artikula -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold">What is Artikula?</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Artikula is a digital platform for publishing and discovering articles,
                        designed to help readers find relevant information and enable writers
                        to share ideas in a structured way.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        In an era of overwhelming information, Artikula aims to be a space
                        that prioritizes content quality, readability, and ease of access.
                    </p>
                </div>

                <!-- Vision -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold">Vision</h2>
                    <p class="text-gray-700 leading-relaxed">
                        To become a digital reading space that encourages literacy,
                        critical thinking, and open exchange of ideas.
                    </p>
                </div>

                <!-- Mission -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold">Mission</h2>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Provide a structured and easy-to-use article publishing platform</li>
                        <li>Enable efficient and relevant article discovery</li>
                        <li>Support writers, academics, and readers in sharing knowledge</li>
                        <li>Create a comfortable and inclusive reading experience</li>
                    </ul>
                </div>

                <!-- Core Values -->
                <!-- Core Values -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold">Core Values</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Accessibility -->
                        <div class="bg-white p-6 rounded-lg border flex items-center gap-4">
                            <div class="shrink-0">
                                <x-icons.accessibility class="text-emerald-600" size="40" />
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Accessibility</h3>
                                <p class="text-sm text-gray-600">
                                    Knowledge should be easy to discover and accessible to everyone.
                                </p>
                            </div>
                        </div>

                        <!-- Quality -->
                        <div class="bg-white p-6 rounded-lg border flex items-center gap-4">
                            <div class="shrink-0">
                                <x-icons.check class="text-emerald-600" size="40" />
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Quality</h3>
                                <p class="text-sm text-gray-600">
                                    Content that is informative, relevant, and responsibly written.
                                </p>
                            </div>
                        </div>

                        <!-- Openness -->
                        <div class="bg-white p-6 rounded-lg border flex items-center gap-4">
                            <div class="shrink-0">
                                <x-icons.side-menu size='32' class="text-emerald-600" />
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Openness</h3>
                                <p class="text-sm text-gray-600">
                                    A space that welcomes diverse perspectives and ideas.
                                </p>
                            </div>
                        </div>

                        <!-- Sustainability -->
                        <div class="bg-white p-6 rounded-lg border flex items-center gap-4">
                            <div class="shrink-0">
                                <x-icons.sustainability class="text-emerald-600" size="40" />
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Sustainability</h3>
                                <p class="text-sm text-gray-600">
                                    A platform designed to grow alongside its community.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Founder Section -->
            <section class="max-w-4xl mx-auto px-6 py-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">Behind Artikula</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Artikula is created and maintained by an individual who believes
                        in open knowledge, quality writing, and accessible information.
                    </p>
                </div>

                <div class="bg-white border rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8">
                    <!-- Avatar -->
                    <img src="/img/founder-img.jpg" alt="Founder" class="w-32 h-32 rounded-full object-cover object-top">

                    <!-- Info -->
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-semibold mb-1">Rayhan Muhammad Alfarizi</h3>
                        <p class="text-emerald-600 font-medium mb-4">
                            Founder · Software Engineer · Web Developer
                        </p>

                        <p class="text-gray-700 leading-relaxed max-w-xl">
                            Artikula was initiated as a personal project to create
                            a structured and meaningful digital reading space.
                            I handle platform development, content curation,
                            and editorial direction.
                        </p>

                        <!-- Optional Links -->
                        <div class="mt-6 flex justify-center md:justify-start gap-4">
                            <a wire:navigate href="/blogs?author=rymalfarizi"
                                class="text-sm font-medium text-emerald-600 hover:underline">
                                View articles
                            </a>
                            <a href="https://letsgobois24.github.io/my-portofolio" target="_blank"
                                class="text-sm font-medium text-gray-500 hover:underline">
                                Personal website
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action -->
            <section class="bg-emerald-600 text-white">
                <div class="max-w-5xl mx-auto px-6 py-16 text-center">
                    <h2 class="text-3xl font-bold mb-4">
                        Be Part of Artikula
                    </h2>
                    <p class="text-emerald-100 mb-6">
                        Read, write, and share your ideas in an open digital reading space.
                    </p>
                    <a wire:navigate.hover href="/blogs"
                        class="inline-block bg-white text-emerald-700 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition">
                        Explore Articles
                    </a>
                </div>
            </section>

        </main>
