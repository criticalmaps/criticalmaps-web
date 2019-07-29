package actions

import "github.com/gobuffalo/buffalo"

func GalleryHandler(c buffalo.Context) error {
	return c.Render(200, r.HTML("gallery.html"))
}
