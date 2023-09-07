using System.ComponentModel.DataAnnotations;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using System.IO;
using System.Threading.Tasks;

namespace YourNamespace.Pages
{
    public class IndexModel : PageModel
    {
        [BindProperty]
        public Person Person { get; set; }

        [BindProperty]
        public IFormFile ProfilePicture { get; set; }

        public bool DisplayData { get; set; } = false;

        public void OnGet()
        {
            // Initialize any data if needed when the page loads.
        }

        public async Task<IActionResult> OnPost()
        {
            if (!ModelState.IsValid)
            {
                // Form validation failed, return the page with validation errors.
                return Page();
            }

            // Handle the file upload (save it to a folder, database, etc.).
            if (ProfilePicture != null && ProfilePicture.Length > 0)
            {
                var uploadsDirectory = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot/uploads");
                Directory.CreateDirectory(uploadsDirectory);
                var filePath = Path.Combine(uploadsDirectory, ProfilePicture.FileName);

                using (var fileStream = new FileStream(filePath, FileMode.Create))
                {
                    await ProfilePicture.CopyToAsync(fileStream);
                }
            }

            // Form validation passed, set the DisplayData property to true.
            DisplayData = true;

            // Redirect to a success page or return a success message.
            return Page();
        }
    }

    public class Person
    {
        [Required(ErrorMessage = "Name is required.")]
        public string Name { get; set; }

        [Required(ErrorMessage = "Age is required.")]
        [Range(1, 120, ErrorMessage = "Age must be between 1 and 120.")]
        public int Age { get; set; }
    }
}
