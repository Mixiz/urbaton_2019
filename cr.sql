CREATE TABLE public.events
(
    id integer NOT NULL,
    out_id integer,
    "desc" text COLLATE pg_catalog."default",
    coords text COLLATE pg_catalog."default",
    url text COLLATE pg_catalog."default",
    start_date bigint,
    end_date bigint,
    CONSTRAINT events_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.events
    OWNER to postgres;
