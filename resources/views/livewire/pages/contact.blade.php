@section('meta_description',
    'Contact Artikula for inquiries, feedback, collaborations, or contributions. We are open to
    ideas and meaningful discussions.')

    <main class="bg-neutral-100 text-gray-800">
        <!-- Hero -->
        <section class="bg-white border-b">
            <div class="max-w-5xl mx-auto px-6 py-20 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Contact Artikula
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    We welcome questions, feedback, and collaboration inquiries.
                    Feel free to reach out to us.
                </p>
            </div>
        </section>

        <!-- Contact Content -->
        <section class="max-w-5xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12">

            <!-- Contact Info -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold">Get in Touch</h2>

                <p class="text-gray-700 leading-relaxed">
                    Artikula is an independent digital reading platform.
                    If you have ideas, suggestions, or are interested in contributing,
                    we would be happy to hear from you.
                </p>

                <div class="space-y-4 text-sm text-gray-700">
                    <div class="flex items-center gap-3">
                        <x-icons.email size="24" class="text-emerald-600" />
                        <span>rayhanmalfarizi@gmail.com</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-icons.location size="24" class="text-emerald-600" />
                        <span>Indonesia</span>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white border rounded-xl p-8">
                <h3 class="text-xl font-semibold mb-6">Send a Message</h3>

                <form wire:submit='sendMessage' class="space-y-5">
                    <x-form.input variant="contact" name="name" placeholder="Your name" label="Name" />
                    <x-form.input variant="contact" name="email" placeholder="you@example.com" label="Email" />
                    <x-form.input variant="contact" name="subject" placeholder="Subject of your message" label="Subject" />
                    <x-form.textarea name="message" placeholder="Write your message here..." label="Message" />
                    <x-ui.submit-button target="">Send Message</x-ui.submit-button>
                </form>
            </div>

        </section>

        <!-- Footer Note -->
        <section class="max-w-5xl mx-auto px-6 pb-16 text-center">
            <p class="text-sm text-gray-500">
                We aim to respond to all messages within a reasonable time.
                Thank you for reaching out to Artikula.
            </p>
        </section>

    </main>
