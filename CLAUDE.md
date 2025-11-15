# CLAUDE.md - AI Assistant Development Guide

## Project Overview

**Project Name:** webapp
**Type:** Web Application
**Current Stage:** Early Development
**Tech Stack:** HTML, CSS, JavaScript (Vanilla)

This is a web application project currently in its initial development phase. The project contains a user registration interface and is being developed with assistance from AI tools including GitHub Copilot and Claude.

## Repository Structure

```
webapp/
├── README.md              # Project description
├── register.html          # User registration page with form
├── CLAUDE.md             # This file - AI assistant guide
└── .git/                 # Git repository data
```

### Current Files

- **register.html** (5588 bytes, 187 lines)
  - Location: `/home/user/webapp/register.html`
  - Purpose: Registration form with username, full name, gender, and password fields
  - Styling: Embedded CSS with gradient design (purple/blue theme)
  - Functionality: Client-side form validation and submission handling
  - Key features:
    - Responsive design (mobile-friendly)
    - Modern gradient UI (#667eea to #764ba2)
    - Form validation with required fields
    - Gender selection (male/female/other)
    - Client-side JavaScript form handling

## Development Workflow

### Branch Strategy

The project follows a feature branch workflow:

- **Main Branch:** `main` (or default branch)
- **Claude Development Branches:** Use format `claude/claude-md-{session-id}`
- **Current Working Branch:** `claude/claude-md-mi08aqhj37i2fqvc-014rdNdJropzDRu2JWLws5Mg`

### Git Workflow for AI Assistants

1. **Always work on the designated Claude branch**
2. **Commit frequently** with descriptive messages
3. **Push to the feature branch** when changes are complete
4. **Use format:** `git push -u origin <branch-name>`
5. **Branch naming:** Must start with `claude/` and end with session ID

### Commit History

Recent commits show collaborative AI development:
- `4508488` - Merge pull request #2 from NPKMUTNB/copilot/fix-1
- `aee039d` - Add register.html with complete registration form
- `a80f7b2` - Initial plan
- `6f4c11c` - Initial commit

## Technical Stack & Conventions

### Frontend

**Current Implementation:**
- Pure HTML5 with semantic markup
- CSS3 with modern features (flexbox, gradients, transitions)
- Vanilla JavaScript (ES6+)
- No build tools or frameworks currently in use

**Styling Conventions:**
- Embedded CSS in HTML files (for now)
- Color scheme: Purple/blue gradient (#667eea, #764ba2)
- Font: Segoe UI, Tahoma, Geneva, Verdana, sans-serif
- Responsive design with media queries
- Mobile-first approach

**JavaScript Conventions:**
- Event listeners for form handling
- Form validation using HTML5 validation
- Console logging for debugging
- Alert-based user feedback (temporary - should be enhanced)

### Code Style

**HTML:**
- 4-space indentation
- Semantic HTML5 elements
- Required attributes for form inputs
- Placeholder text for user guidance

**CSS:**
- Reset/normalize using universal selector
- BEM-like class naming (e.g., `register-container`, `form-group`)
- Transition effects for interactivity
- Mobile-responsive breakpoints at 480px

**JavaScript:**
- addEventListener for event handling
- FormData API for form processing
- Arrow functions preferred
- const/let instead of var

## Key Conventions for AI Assistants

### File Operations

1. **Always prefer editing existing files** over creating new ones
2. **Read files before editing** to understand current state
3. **Use specialized tools:**
   - `Read` for reading files
   - `Edit` for modifying files
   - `Write` only for new files
   - Avoid bash commands for file operations

### Development Process

1. **Use TodoWrite tool** to plan and track multi-step tasks
2. **Mark todos as in_progress** before starting work
3. **Mark completed immediately** after finishing each task
4. **Commit changes** with clear, descriptive messages
5. **Follow git safety protocols:**
   - Never force push to main/master
   - Don't skip hooks without explicit permission
   - Always check authorship before amending

### Security Considerations

**Important Security Notes:**

1. **Form Security Issues to Address:**
   - Currently no backend validation
   - Password shown in console logs (line 184 in register.html:184)
   - No CSRF protection
   - No input sanitization
   - Form action points to "#" (needs backend endpoint)

2. **When Adding Features:**
   - Implement proper password hashing
   - Add server-side validation
   - Sanitize all user inputs
   - Protect against XSS, SQL injection, CSRF
   - Never log sensitive data

### Testing & Validation

**Current State:**
- No automated tests yet
- Manual testing through browser
- Form validation using HTML5 attributes

**Recommendations for Future:**
- Add unit tests (Jest, Mocha, or similar)
- Implement E2E tests (Playwright, Cypress)
- Add code linting (ESLint)
- Consider TypeScript for type safety

## Project Architecture

### Current Architecture

```
Frontend (Static HTML)
├── register.html (standalone page)
└── Inline JavaScript handlers
```

### Recommended Future Architecture

```
Frontend
├── pages/
│   ├── register.html
│   ├── login.html
│   └── index.html
├── css/
│   └── styles.css
├── js/
│   ├── main.js
│   └── utils.js
└── assets/
    └── images/

Backend (Future)
├── api/
│   ├── auth/
│   └── users/
└── database/
```

## Common Tasks & Patterns

### Adding a New Page

1. Create HTML file in root (or future `pages/` directory)
2. Include consistent styling matching register.html theme
3. Ensure responsive design
4. Add navigation links between pages
5. Test on mobile and desktop viewports

### Modifying Styles

1. Current styles are embedded in HTML `<style>` tags
2. Future: Extract to separate CSS file for reusability
3. Maintain color scheme consistency
4. Test responsive breakpoints

### Adding Form Functionality

1. Use FormData API for data collection
2. Add HTML5 validation attributes
3. Implement client-side validation
4. Plan for backend endpoint integration
5. Handle error states gracefully

## Environment Information

- **Platform:** Linux
- **Git:** Repository initialized and tracked
- **Working Directory:** `/home/user/webapp`

## Development Guidelines

### Before Starting Work

1. Check current git branch
2. Review recent commits for context
3. Read existing files to understand structure
4. Create todo list for multi-step tasks

### During Development

1. Make incremental changes
2. Test frequently in browser
3. Commit logical units of work
4. Update documentation as needed
5. Consider security implications

### Before Committing

1. Review all changes with `git diff`
2. Check `git status` for untracked files
3. Write clear commit messages explaining "why"
4. Ensure no sensitive data is committed
5. Verify code follows project conventions

### Creating Pull Requests

1. Check full commit history for branch
2. Draft comprehensive PR summary
3. Include test plan checklist
4. Reference related issues if applicable
5. Push to feature branch first

## Future Enhancements Roadmap

### Immediate Needs

- [ ] Extract CSS to separate file
- [ ] Add login page to complement registration
- [ ] Implement backend API for form submission
- [ ] Add proper password security
- [ ] Create navigation structure

### Short-term Goals

- [ ] Set up build tools (webpack/vite)
- [ ] Add form validation library
- [ ] Implement user authentication
- [ ] Create database schema
- [ ] Add error handling and user feedback

### Long-term Vision

- [ ] Full user management system
- [ ] Dashboard/profile pages
- [ ] Email verification
- [ ] Password reset functionality
- [ ] Admin panel
- [ ] Analytics and monitoring

## Troubleshooting

### Common Issues

**Forms not submitting:**
- Check that `e.preventDefault()` is working
- Verify form action and method attributes
- Inspect browser console for JavaScript errors

**Styling issues:**
- Check browser compatibility
- Verify CSS syntax
- Test responsive breakpoints
- Clear browser cache

**Git push failures:**
- Ensure branch name starts with `claude/`
- Verify network connectivity
- Check remote repository access
- Retry with exponential backoff if network error

## Resources & References

### Project Files
- README.md:1 - Project overview
- register.html:1-187 - Registration form implementation

### Key Code Locations
- Form submission handler: register.html:167-186
- Styling: register.html:7-119
- Form structure: register.html:128-163

### External Resources
- HTML5 Form Validation: https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation
- CSS Gradients: https://developer.mozilla.org/en-US/docs/Web/CSS/gradient
- FormData API: https://developer.mozilla.org/en-US/docs/Web/API/FormData

## Notes for AI Assistants

### Communication Style
- Be concise and technical
- Avoid emojis unless requested
- Output markdown-formatted text
- Never use bash echo for communication

### Tool Usage
- Prefer specialized tools over bash commands
- Use Task tool for complex exploration
- Run independent operations in parallel
- Never guess parameter values

### Quality Standards
- Prioritize security in all implementations
- Follow existing code patterns
- Maintain consistency with current style
- Test changes thoroughly before committing

---

**Last Updated:** 2025-11-15
**Document Version:** 1.0
**Maintained By:** Claude AI Assistant
